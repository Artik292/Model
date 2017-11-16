<?php

require 'vendor/autoload.php';
$app = new \atk4\ui\App('Model');
$app->initLayout('Centered');

$db = new \atk4\data\Persistence_SQL('mysql:dbname=for_colibri;host=localhost','root','');

class User extends \atk4\data\Model {
  	public $table = 'logintable';
function init() {
  	parent::init();
  	$this->addField('name');
    $this->addField('surname');
    /*$this->addField('phone_number');
    $this->addField('e-mail');*/
  	$this->addField('password',['type'=>'password']);
    /*$this->addField('birthday',['type'=>'date']);
    $this->addField('notes');*/
}
}

$CRUD = $app->layout->add('CRUD');
$CRUD->setModel(new User($db));

$form = $app->layout->add('Form');
$form->setModel(new User($db));

$form->onSubmit(function($form) {
	$form->model->save();
	return $form->success('Record updated');

});
