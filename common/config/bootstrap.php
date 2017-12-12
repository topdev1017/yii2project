<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('backend_theme', dirname(dirname(__DIR__)) . '/themes/backend_theme');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
//Yii::$container->set(
//    'schmunk42\giiant\crud\providers\EditorProvider',
//    [
//        'columnNames' => ['description']
//    ]
//);
//Yii::$container->set(
//    'schmunk42\giiant\crud\providers\OptsProvider'
//);
//Yii::$container->set(
//    'schmunk42\giiant\crud\providers\CallbackProvider'
//);
//Yii::$container->set(
//    'schmunk42\giiant\crud\providers\DateTimeProvider'
//);
//Yii::$container->set(
//    'schmunk42\giiant\crud\providers\RelationProvider'
//);

/*schmunk42\giiant\crud\providers\EditorProvider,
schmunk42\giiant\crud\providers\OptsProvider,
schmunk42\giiant\crud\providers\CallbackProvider,
schmunk42\giiant\crud\providers\RelationProvider,*/