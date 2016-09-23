<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $ankietyId = [1, 2];


        /* @var $db \Zend_Db_Adapter_Abstract */
        $db = Zend_Registry::get('db');


        /* pobranie pierwszej ankiety */
        $select = new Zend_Db_Select($db);
        $select->from('ankieta');
        $select->where('id = ?', $ankietyId[0]);
        $nowaAnkieta = $db->fetchRow($select);

        /* przygotowanie danych do zapisu */
        $nowaAnkieta['id'] = null;
        $nowaAnkieta['tytul'] = 'Tytul3';
        $nowaAnkieta['tytul_wew'] = 'Tytul3';

        /* utworzenie trzeciej ankiety */
        $db->insert('ankieta', $nowaAnkieta);
        $nowaAnkieta['id'] = $db->lastInsertId();


        /* pobranie logów dla ankiet */
        $select = new Zend_Db_Select($db);
        $select->from('log');
        $select->where('id_ankieta IN (?)', $ankietyId);
        $logi = $db->fetchAll($select);

        /* zapisanie nowych logów */
        $logiId = []; // tablica starych id logów wraz z ich nowym id
        foreach ($logi as $log) {
            $stareId = $log['id'];
            $log['id'] = null;
            $log['id_ankieta'] = $nowaAnkieta['id'];
            $db->insert('log', $log);
            $noweId = $db->lastInsertId();
            $logiId[$stareId] = $noweId;
        }


        /* pobranie wyników dla ankiet */
        $select = new Zend_Db_Select($db);
        $select->from('wynik');
        $select->where('id_ankieta IN (?)', $ankietyId);
        $wyniki = $db->fetchAll($select);

        /* zapisanie nowych wyników */
        foreach ($wyniki as $wynik) {
            $wynik['id'] = null;
            $wynik['id_ankieta'] = $nowaAnkieta['id'];
            $staryIdLog = $wynik['id_log'];
            $wynik['id_log'] = isset($logiId[$staryIdLog]) ? $logiId[$staryIdLog] : 0;
            $db->insert('wynik', $wynik);
        }



        exit;
    }
}

