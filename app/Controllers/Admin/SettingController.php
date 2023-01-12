<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
		$db = db_connect();
		$query = $db->query("select * from setting")->getRow();
		$data['setting'] = $query;

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
		session()->setFlashdata('success', 'News updated');
		return redirect('admin/setting');
	}
}
