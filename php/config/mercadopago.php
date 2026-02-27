<?php
// config/mercadopago.php

// Token do Mercado Pago
define('MP_ACCESS_TOKEN', 'TEST-3868722746614536-122214-1079155885403bd37ff44a384ce3735b-2010928981');

// URL base da API
define('MP_API_URL', 'https://api.mercadopago.com');

// Modo debug (true = mostra erros)
define('MP_DEBUG', true);

// Chave pública (publishable key) usada no frontend para tokenizar cartão
// Defina sua chave pública de testes (sandbox) aqui. Ex: 'TEST-...'
define('MP_PUBLIC_KEY', 'TEST-e01842e4-8dde-4da7-8d8f-3915ace74f87');
