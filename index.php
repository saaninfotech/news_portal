<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Index file and this will act as the entry point for the application.
 *
 * @author: Saurabh Sinha
 * @created on: 02/15/12 11:33 AM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

require_once("bootstrap.php");

//This creates the new registry for the application.
$registry = new registry;

//This creates the database registry object.
$registry->db = new Database($__host, $__user, $__password, $__database);

//This initializes the router of the application.
$registry->router = new router($registry);

//This initializes the required model.
$registry->model = new SaanModel($registry->db, $registry->router->getFile());

//This initializes the specified template
$registry->template = new template($registry);

//This initializes the Validation Class
$registry->validation = new Validation();

//This initialize the Security Class
$registry->security = new Security();

//This initializes the Image Resize Class
$registry->image = new ImageResize();

//This initializes the Mailer Class
$registry->mailer = Swift_Mailer::newInstance($transport);

//This sets the DB for the Static Model Class
appModel::setDB($registry->db);

//This initializes the required Controller.
$registry->router->dispatch();

