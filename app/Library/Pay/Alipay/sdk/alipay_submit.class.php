<?php
require_once 'alipay_core.function.php'; class AlipaySubmit { var $alipay_config; var $alipay_gateway_new = 'https://mapi.alipay.com/gateway.do?'; function __construct($spcdbaf5) { $this->alipay_config = $spcdbaf5; } function AlipaySubmit($spcdbaf5) { $this->__construct($spcdbaf5); } function buildRequestMysign($sp7775da) { $spf28067 = createLinkString($sp7775da); switch (strtoupper(trim($this->alipay_config['sign_type']))) { case 'MD5': $sp036b38 = md5Sign($spf28067, $this->alipay_config['key']); break; default: $sp036b38 = ''; } return $sp036b38; } function buildRequestPara($spa6f8bd) { $sp126299 = paraFilter($spa6f8bd); $sp7775da = argSort($sp126299); $sp036b38 = $this->buildRequestMysign($sp7775da); $sp7775da['sign'] = $sp036b38; $sp7775da['sign_type'] = strtoupper(trim($this->alipay_config['sign_type'])); return $sp7775da; } function buildRequestParaToString($spa6f8bd) { $sp012ade = $this->buildRequestPara($spa6f8bd); $sp66660e = createLinkStringUrlEncode($sp012ade); return $sp66660e; } function buildRequestForm($spa6f8bd, $sp888af6, $spbdc5cc) { $sp012ade = $this->buildRequestPara($spa6f8bd); $sp7461d6 = '<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'' . $this->alipay_gateway_new . '_input_charset=' . trim(strtolower($this->alipay_config['input_charset'])) . '\' method=\'' . $sp888af6 . '\'>'; foreach ($sp012ade as $sp7b7024 => $spcb4459) { $sp7461d6 .= '<input type=\'hidden\' name=\'' . $sp7b7024 . '\' value=\'' . $spcb4459 . '\'/>'; } $sp7461d6 = $sp7461d6 . '<input type=\'submit\'  value=\'' . $spbdc5cc . '\' style=\'display:none;\'></form>'; $sp7461d6 = $sp7461d6 . '<script>document.forms[\'alipaysubmit\'].submit();</script>'; return $sp7461d6; } function query_timestamp() { $sp3ae187 = $this->alipay_gateway_new . 'service=query_timestamp&partner=' . trim(strtolower($this->alipay_config['partner'])) . '&_input_charset=' . trim(strtolower($this->alipay_config['input_charset'])); $sp7bba7e = new DOMDocument(); $sp7bba7e->load($sp3ae187); $sp7bf1e4 = $sp7bba7e->getElementsByTagName('encrypt_key'); $spa8489e = $sp7bf1e4->item(0)->nodeValue; return $spa8489e; } }