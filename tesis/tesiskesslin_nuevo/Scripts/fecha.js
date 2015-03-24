
function FechaCompleta(fecha)
{var newfecha=fecha.split("-");var dia=newfecha[0];var mes=newfecha[1];var annio=newfecha[2];var fnacimiento=annio.concat("-",mes,"-",dia);return fnacimiento;}
function Convertir(campo)
{var index;var tmpStr;var tmpChar;var preString;var postString;var strLen;tmpStr=campo.value.toLowerCase();strLen=tmpStr.length;if(strLen>0)
{for(index=0;index<strLen;index++)
{if(index==0)
{tmpChar=tmpStr.substring(0,1).toUpperCase();postString=tmpStr.substring(1,strLen);tmpStr=tmpChar+postString;}
else
{tmpChar=tmpStr.substring(index,index+1);if(tmpChar==""&&index<(strLen-1))
{tmpChar=tmpStr.substring(index+1,index+2).toUpperCase();preString=tmpStr.substring(0,index+1);postString=tmpStr.substring(index+2,strLen);tmpStr=preString+tmpChar+postString;}}}}
return tmpStr;}
function VerificaDia(h,m,t)
{var hora;switch(t)
{case'0':if(h<12)
{hora=h.concat(":",m);}
else
{h='00';hora=h.concat(":",m);}
break;case'1':if(h!=12)
{h=parseInt(h);h=h+12;h=h.toString();}
hora=h.concat(":",m);break;}
return hora;}
function HoraDiaria(entrada,salida,condicion,refigerio)
{var newEntrada=entrada.split(":");var newSalida=salida.split(":");if(refigerio=='')
refigerio='0';var m_refri=parseInt(refigerio);var h_refri=0;var resto=m_refri%60;if(resto>=1)
{h_refri=1;m_refri=m_refri-60;}
if(!(condicion==1))
{var hora=parseInt(newSalida[0])-parseInt(newEntrada[0]);var minu=parseInt(newSalida[1])-parseInt(newEntrada[1]);}
else
{var hora=24-parseInt(newEntrada[0])+parseInt(newSalida[0]);var minu=parseInt(newSalida[1])-parseInt(newEntrada[1]);}
hora=hora-h_refri;minu=minu-m_refri;if(minu<0)
{resto=-1*minu;resto=parseFloat(resto);resto=resto/60;var mul=1;if(resto>1)
mul=2;hora=hora-mul;minu=(60*mul)+minu;}
if(minu>=60)
{hora=hora+1;minu=minu-60;}
hora=hora.toString();minu=minu.toString();if(hora=='0')
hora='00';if(minu=='0')
minu='00';var horaxdia=hora.concat(":",minu);return horaxdia;}