<?php namespace App\Database;

  /**
   *
   */
  class Config {

    /**
     * Return an array with the databases that the system contains.
     * Utilized by the migrations.
     *
     * @return Array with the name of databases.
     */
    public static function getDataBases()
    {
      $lDataBases = array();

      $i = 0;
      $lDataBases[$i++] = 'siie_cartro';
      $lDataBases[$i++] = 'siie_aeth';

      return $lDataBases;
    }

    /**
     * Return the connection of the system database.
     *
     * @return String name of connection
     */
    public static function getConnSys()
    {
      return 'ssystem';
    }
  }
