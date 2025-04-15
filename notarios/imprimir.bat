@echo off
NET USE LPT1: \\192.168.1.81\HPJCWEB /persistent:yes
type "C:\inetpub\wwwroot\notarios_multiplee\imprimir.txt" > lpt1
exit

