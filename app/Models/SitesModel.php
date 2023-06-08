<?php

namespace App\Models;

use CodeIgniter\Model;

class SitesModel extends Model
{
    protected $table = 'sites';

    protected $allowedFields = [
        'page_url',
        'account_id',
        'page_name'
    ];

    public function add_links($links = []) {
        $builder = $this->db->table('links');
        return $builder->insertBatch($links);
    }

    public function get_sites() {
        $builder = $this->db->table('sites');
        $builder->select('page_name, count(*) as link_count, sites.id');
        $builder->join('links', 'links.page_id = sites.id');
        $builder->groupBy('sites.id');
        return $builder->get()->getResult('array');
    }
}