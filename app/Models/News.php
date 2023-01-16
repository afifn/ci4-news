<?php

namespace App\Models;

use CodeIgniter\Model;

class News extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'news';
	protected $primaryKey           = 'id_news';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_category',
		'title',
		'author',
		'slug',
		'content',
		'poster',
		'created_at'
	];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function category()
	{
		$this->db->table('news');
		$this->select('news.id_news, news.id_category, news.title, news.author, news.content, news.slug as slug, news.poster, news.created_at, category.name as category');
		$this->join('category', 'news.id_category = category.id_category');
		return $this->findAll();
	}

	public function pagerNews($perPager = null, $offset = null)
	{
		$builder = $this->db->table('news');
		return $builder
			->select('news.id_news, news.id_category, news.title, news.author, news.content, news.slug as slug, news.poster, news.created_at, category.name as category')
			->join('category', 'news.id_category = category.id_category')
			->orderBy('id_news', 'DESC')
			->limit($perPager, $offset)
			->get()
			->getResult();
	}

	public function findWithCategory($id_news)
	{
		$this->db->table('news');
		$this->select('news.title as title, news.author, news.content, news.poster, news.created_at, category.name as category');
		$this->join('category', 'news.id_category = category.id_category');
		$this->where('news.id_news =' . $id_news);
		return $this->find();
	}

	public function findWithSlug($slug)
	{
		$this->db->table('news');
		$this->select('news.title as title, news.author, news.content, news.poster, news.slug, news.created_at, category.name as category');
		$this->join('category', 'news.id_category = category.id_category');
		$this->where('news.slug', $slug);
		return $this->find();
	}

	public function findCategoryByName($name)
	{
		$this->db->table('news');
		$this->select('news.id_news, news.title, category.name as category, news.author, news.content, news.poster');
		$this->join('category', 'news.id_category = category.id_category');
		$this->where('category.name', $name);
		$this->orderBy('id_news', 'DESC');
		return $this->findAll();
	}
}
