<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\Utils;

class PostsModel extends BaseModel
{
    protected $table = 'tbl_posts';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['post_id', 'post_title', 'post_content', 'post_introduce',
        'post_status', 'post_type', 'attachment', 'category_id', 'lang',
        'post_creator', 'role_creator','number_order', 'created_at', 'deleted_at', 'updated_at'
        ,'slug','seo_id'];
    /*processing before insert into database*/
    protected function beforeInsert(array $data)
    {
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /*processing after insert into database*/
    protected function beforeUpdate(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    public function search($data,$menu= false,$page=false,$dynamic_page=false)
    {
        $this->select('*, tbl_posts.lang as lang');
        if (isset($data['category_id']) && $data['category_id'] != '') {
            $this->where('tbl_posts.post_id', $data['category_id']);
        }
        if (isset($data['category_id_post']) && $data['category_id_post'] != '') {
            $this->where('tbl_posts.category_id', $data['category_id_post']);
        }
        if (isset($data['post_type']) && $data['post_type'] != '') {
            $this->where('tbl_posts.post_type', $data['post_type']);
        }
        if (isset($data['post_status']) && $data['post_status'] != '') {
            $this->where('tbl_posts.post_status', $data['post_status']);
        }
        if (isset($data['post_title']) && $data['post_title'] != '') {
            $this->like('tbl_posts.post_title', $data['post_title']);
        }
        if (isset($data['post_slug']) && $data['post_slug'] != '') {
            $this->like('tbl_posts.slug', $data['post_slug']);
        }
        if (isset($data['lang']) && $data['lang'] != '') {
            $this->where('tbl_posts.lang', $data['lang']);
        }
        // dùng cho search menu theo danh mục menu
        if ($menu) {
            $this->where('tbl_posts.category_id', MENU_ID);
            // dùng cho search page theo danh mục page
        } elseif($page) {
            $this->where('tbl_posts.category_id', PAGE_ID);
        }
        elseif($dynamic_page) {
            $this->where('tbl_posts.category_id', DYNAMIC_PAGE_ID);
        }
        else {
            // voi danh sach post se k hien ra nhung bai menu và page
            $this->where('tbl_posts.category_id !=', MENU_ID);
            $this->where('tbl_posts.category_id !=', PAGE_ID);
            $this->where('tbl_posts.category_id !=', DYNAMIC_PAGE_ID);
        }

        $this->where('tbl_posts.deleted_at', null);
        $this->where('tbl_posts.category_id !=', null);
        $this->orderBy('tbl_posts.lang', 'desc');
        $this->orderBy('tbl_posts.created_at', 'desc');
        $this->orderBy('tbl_posts.number_order', 'asc');
    }

    public function searchCategory($data)
    {
        $this->select('*, tbl_posts.lang as lang');
        if (isset($data['post_type']) && $data['post_type'] != '') {
            $this->where('tbl_posts.post_type', $data['post_type']);
        }
        if (isset($data['post_title']) && $data['post_title'] != '') {
            $this->like('tbl_posts.post_title', $data['post_title']);
        }
        if (isset($data['lang']) && $data['lang'] != '') {
            $this->where('tbl_posts.lang', $data['lang']);
        }
        $this->where('tbl_posts.deleted_at', null);
        $this->where('tbl_posts.category_id', null);
        $this->orderBy('tbl_posts.lang', 'desc');
        $this->orderBy('tbl_posts.created_at', 'desc');
        $this->orderBy('tbl_posts.number_order', 'asc');
    }


    // search frontend
    public function searchByConditions($data)
    {
        if (isset($data['post_type']) && $data['post_type'] != '') {
            $this->where('post_type', $data['post_type']);
        }
        if (isset($data['post_status']) && $data['post_status'] != '') {
            $this->where('post_status', $data['post_status']);
        }
        if (isset($data['category_id']) && $data['category_id'] != '') {
            $this->where('category_id', $data['category_id']);
        }
        if (isset($data['post_title']) && $data['post_title'] != '') {
            $this->like('post_title', $data['post_title']);
        }
        if (isset($data['lang']) && $data['lang'] != '') {
            $this->where('lang', $data['lang']);
        }
        $this->where('deleted_at', null);
        $this->where('category_id !=', null);
        $this->limit(4);
        $this->orderBy('updated_at', 'desc');
        return $this->get()->getResultArray();
    }

    public function paginate_custom($data)
    {
        if (isset($data['post_status']) && $data['post_status'] != '') {
            $this->where('post_status', $data['post_status']);
        }
        if (isset($data['category_id']) && $data['category_id'] != '') {
            $this->where('category_id', $data['category_id']);
        }
        $this->where('deleted_at', null);
        $this->orderBy('lang', 'desc');
        $this->orderBy('created_at', 'desc');
        $this->orderBy('number_order', 'asc');
    }
}