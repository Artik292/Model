<?php

require 'vendor/autoload.php';
$app = new \atk4\ui\App('Model');
$app->initLayout('Centered');


        if (isset($_ENV['CLEARDB_DATABASE_URL'])) {

          preg_match('|([a-z]+)://([^:]*)(:(.*))?@([A-Za-z0-9\.-]*)(/([0-9a-zA-Z_/\.]*))|',

          $_ENV['CLEARDB_DATABASE_URL'],$matches);

          $dsn=array(

            $matches[1].':host='.$matches[5].';dbname='.$matches[7],

            $matches[2],

            $matches[4]

          );

          $db = new \atk4\data\Persistence_SQL($dsn[0].';charset=utf8', $dsn[1], $dsn[2]);

        } else {

           $db = new \atk4\data\Persistence_SQL('mysql:dbname=for_colibri;host=localhost','root','');

            //$this->db = new \atk4\data\Persistence_SQL('mysql:host=127.0.0.1;dbname=library;charset=utf8', 'root', 'root');

        }

//$db = new \atk4\data\Persistence_SQL('mysql:dbname=for_colibri;host=localhost','root','');

class User extends \atk4\data\Model {
  	public $table = 'logintable';
function init() {
  	parent::init();
  	$this->addField('name');
    $this->addField('surname');
    $this->addField('phone_number');
    $this->addField('e-mail');*/
  	$this->addField('password',['type'=>'password']);
    $this->addField('birthday',['type'=>'date']);
    $this->addField('notes');
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
