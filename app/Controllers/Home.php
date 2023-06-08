<?php

namespace App\Controllers;
use App\Models\SitesModel;
use Eddieace\PhpSimple\HtmlDomParser;

class Home extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        return view('home');
    }

    private function parse_url($url) {
        if  ( $ret = parse_url($url) ) {
            if ( !isset($ret["scheme"]) )
            {
                $url = "https://{$url}";
            }
        }

        return $url;
    }
    public function scrape_page()
    {
        $rules = [
            'page' => 'required|valid_url',
        ];
        $message = '';

        if ($this->validate($rules)) {
            $sites_model = new SitesModel();

            // Scraping the site
            try {
                // checking if the url is already processed
                $page = $this->parse_url($this->request->getVar('page'));
                $existing_sites = $sites_model->where('page_url', $page)->findAll();
                if (count($existing_sites) > 0) {
                    throw new \Exception('Site already processed');
                }

                $dom = HtmlDomParser::file_get_html($page);
                $title = $dom->find('title',0)->innertext;
                $results = $dom->find('a');
                $links = [];
                foreach ($results as $anchor) {
                    $links[] = ['url' => $anchor->href, 'name' => strip_tags($anchor->innertext)];
                }

                // Saving the site
                $result = $sites_model->save(['page_url' => $page,
                    'account_id' =>session()->get('isLoggedIn'),
                    'page_name' => $title]);

                $site_id = $sites_model->getInsertID();
                if ($result) {
                    foreach ($links as $key => $link) {
                        $links[$key]['page_id'] = $site_id;
                    }
                    // Saving the site links
                    $sites_model->add_links($links);
                }
            } catch (\Exception $e) {
                $result = false;
                $message = $e->getMessage();
            }

        } else {
            $result = false;
        }
        $data = [
            'success' => $result,
            'message' => $message
        ];
        return $this->response->setJSON($data);
    }

    public function get_pages()
    {
        $sites_model = new SitesModel();
        $sites = $sites_model->get_sites();
        $response = new \stdClass();
        $response->data = [];

        foreach ($sites as $site) {
            $response->data[] = [$site['page_name'], $site['link_count'], $site['id']];
        }
        return json_encode($response);
    }

    public function get_page_links($page_id)
    {
        return view('links', ['page_id' => $page_id]);
    }

    public function get_page_links_table($page_id)
    {
        $builder = $this->db->table('links');
        $query = $builder->getWhere(['page_id' => $page_id]);
        $links  = $query->getResult('array');
        $response = new \stdClass();
        $response->data = [];

        foreach ($links as $link) {
            $response->data[] = [$link['name'], $link['url']];
        }
        return $this->response->setJSON($response);
    }
}
