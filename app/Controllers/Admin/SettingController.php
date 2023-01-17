<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Gallery;
use App\Models\Setting;

class SettingController extends BaseController
{
	protected $filePath;
	public function __construct()
	{
		$this->filePath = ROOTPATH . 'public/assets/upload/';
	}
	public function index()
	{
		$data['title'] = 'Setting';
		$db = db_connect();
		$query = $db->query("select * from setting")->getRow();
		$data['setting'] = $query;

		$galleries = new Gallery();
		$data['galleries'] = $galleries->findAll();
		// echo '<pre>';
		// print_r($data['gallery']);
		// die();

		return view('admin/setting', $data);
	}

	public function update($id)
	{
		$setting = new Setting();
		$favicon = $this->request->getFile('favicon');
		$logo = $this->request->getFile('logo');

		if (!empty($_FILES['logo']['name']) || !empty($_FILES['favicon']['name'])) {
			if ($this->validate([
				'favicon' => [
					'rules' => 'uploaded[favicon]'
						. '|mime_in[favicon,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
				],
				'logo' => [
					'rules' => 'uploaded[logo]'
						. '|mime_in[logo,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
				]
			])) {
				session()->setFlashdata('error', $this->validator->listErrors());
				return redirect()->back()->withInput();
			}
			$favicon->move($this->filePath);
			$logo->move($this->filePath);

			$baseFile = $setting->where('id_setting', $id)->find();
			@unlink($this->filePath . $baseFile[0]['logo']);
			@unlink($this->filePath . $baseFile[0]['favicon']);

			$setting->update($id, [
				'title' => $this->request->getPost('title'),
				'about' => $this->request->getPost('about'),
				'favicon' => $favicon->getName(),
				'logo' => $logo->getName()
			]);
		} else {
			$setting->update($id, [
				'title' => $this->request->getPost('title'),
				'about' => $this->request->getPost('about'),
			]);
		}
		session()->setFlashdata('success', 'Setting updated');
		return redirect('admin/setting');
	}

	public function store_gallery()
	{
		$gallery = new Gallery();
		if ($this->request->getFileMultiple('file_upload')) {
			if ($this->validate([
				'file_upload' => [
					'rules' => 'uploaded[favicon]'
						. '|mime_in[favicon,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
				]
			])) {
				session()->setFlashdata('error-gallery', $this->validator->listErrors());
				return redirect()->back()->withInput();
			} else {

				foreach ($this->request->getFileMultiple('file_upload') as $file) {
					$title = $file->getName();
					$file->move($this->filePath);
					$data = [
						'title' => $title,
						'created_at' => date('d-m-Y'),
					];
					$gallery->insert($data);
				}
				session()->setFlashdata('success-gallery', 'Gallery uploaded');
				return redirect('admin/setting');
			}
		}
	}
	public function delete_gallery($id)
	{
		$gallery = new Gallery();
		$findId = $gallery->where('id_gallery', $id)->find();
		@unlink($this->filePath . $findId[0]['title']);
		$gallery->delete($id);
		session()->setFlashdata('success-gallery', 'Gallery deleted');
		return redirect('admin/setting');
	}
}
