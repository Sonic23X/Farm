<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventary_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function GetItems()
  {
    # code...
  }

  function GetItemsByLetter($letra = null)
  {
    # code...
  }

  function SearchItem($producto = null)
  {
    # code...
  }

  function InsertItem($data = null)
  {
    # code...
  }

  function Delete($id = null)
  {
    # code...
  }

  function UpdateItem($data = null)
  {
    # code...
  }

}
