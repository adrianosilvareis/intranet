<?php

/**
 * DEFINIÇÕES PLUGIN IMPRESSORAS
 */

/**
 * NOME DO PLUGIN
 */
define("IMP_NOME", "contadores-de-impressao" . DIRECTORY_SEPARATOR);
define("IMP_LOCAL", DIRECTORY_SEPARATOR . "plugin" . DIRECTORY_SEPARATOR . IMP_NOME);
/**
 * Link de acesso externo
 */
define("IMP_INCLUDE", HOME . IMP_LOCAL);
/**
 * Local do arquivo
 */
define("IMP_PATH", REQUIRE_PATH . IMP_LOCAL );