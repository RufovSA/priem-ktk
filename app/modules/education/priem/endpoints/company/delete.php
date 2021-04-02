<?php

$collector->delete(
  'company/{id}',
  function ($id) {

    return api_ok();
  }
);