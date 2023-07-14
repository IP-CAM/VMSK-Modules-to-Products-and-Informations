<?php
class ControllerExtensionModuleVMSKModulesToProducts extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/vmsk_modules_to_products');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('vmsk_modules_to_products', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/vmsk_modules_to_products', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/vmsk_modules_to_products', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

		if (isset($this->request->post['vmsk_modules_to_products_status'])) {
			$data['vmsk_modules_to_products_status'] = $this->request->post['vmsk_modules_to_products_status'];
		} else {
			$data['vmsk_modules_to_products_status'] = $this->config->get('vmsk_modules_to_products_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/vmsk_modules_to_products', $data));
	}

	public function install() {
		$db = $this->db();

		$query = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_module` (
			`product_module_id` int(11) NOT NULL,
			`product_id` int(11) NOT NULL,
			`module_id` int(11) NOT NULL,
			`position` varchar(255) NOT NULL,
			`sort_order` int(3) NOT NULL DEFAULT '0'
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;";
		$db->query($query);

		$query = "
			ALTER TABLE `" . DB_PREFIX . "product_module`
			ADD PRIMARY KEY (`product_module_id`),
			ADD KEY `product_module_id` (`product_module_id`);
		";
		$db->query($query);

		$query = "
			ALTER TABLE `" . DB_PREFIX . "product_module`
			MODIFY `product_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
		";
		$db->query($query);
	}

	private function db() {
		$hostname = DB_HOSTNAME;
		$username = DB_USERNAME;
		$password = DB_PASSWORD;
		$database = DB_DATABASE;
		$port = DB_PORT;

		return new \DB\MySQLi($hostname, $username, $password, $database, $port);
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/vmsk_modules_to_products')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}