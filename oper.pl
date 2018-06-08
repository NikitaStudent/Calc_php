#!/usr/bin/perl

print "Content-type: text/html\n\n";
print "<HTML><BODY>\n";
$method = $ENV{'REQUEST_METHOD'};
if ($method eq 'POST') {
    $length = $ENV{'CONTENT_LENGTH'};
    read(STDIN, $qstr, $length);
}
else {if ($method eq 'GET') {$qstr = $ENV{'QUERY_STRING'};}
else {
    print "Method " . $method . " is not supported </BODY></HTML>";
    exit(0);
}

}
$qstr =~ tr/+/ /;
$qstr =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
@pars = split(/&/, $qstr);
$n_pars = @pars;
foreach $par (@pars) {
    ($name, $value) = split(/=/, $par);
    $opers{$name} = $value;
}
$op1 = int($opers{'A'});
$op2 = int($opers{'B'});
$op = $opers{'op'};
switch: {
    if ($op eq '+') {
        $res = $op1 + $op2;
        last switch;
    }
    if ($op eq '-') {
        $res = $op1 - $op2;
        last switch;
    }
    if ($op eq '*') {
        $res = $op1 * $op2;
        last switch;
    }
    if ($op eq '/') {if ($op2 == 0) {
        print " Divide by zero! </BODY></HTML>";
        exit(0);
    }
    else {
        $res = $op1 / $op2;
        last switch;
    }} {
        print "Operator " . $op . " is not supported </BODY></HTML>";
        exit(0);
    }
} print "Result: " . $op1 . $op . $op2 . ' = ' . $res;
print "<p><a href=\'" . $ENV{'HTTP_REFERER'} . "\'>Back</a></p>";
print "</HTML></BODY>\n";