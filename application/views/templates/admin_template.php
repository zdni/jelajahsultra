<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/admin/head');
$this->load->view('templates/admin/header');
$this->load->view('templates/admin/sidebar');
?>
<?php echo $view_content; ?>
<?php $this->load->view('templates/admin/footer'); ?>
