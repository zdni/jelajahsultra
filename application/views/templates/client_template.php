<?php defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/client/head');
$this->load->view('templates/client/header');
?>
<?php echo $view_content; ?>
<?php $this->load->view('templates/client/footer'); ?>
