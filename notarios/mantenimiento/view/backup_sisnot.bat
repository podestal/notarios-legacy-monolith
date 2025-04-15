@echo off
color 30
echo.
echo.
echo.
echo ===============================================================================
echo.                                  
echo                           = BACKUP AUTOGENERADO SISNOT =
echo.                                 
echo ===============================================================================
Set fecha=%date:~0,2%-%date:~3,2%-%date:~6,4%-
mysqldump --routines=true -B --user=root --password=12345 notarios > C:/Doc_Generados/backup/%fecha%notarios.sql
for %%A in (C:/Doc_Generados/backup/%fecha%notarios.sql) do set size=%%~zA
if %size%==0 (goto INVALID) else (goto VALID)
:INVALID
DEL C:\Doc_Generados\backup\%fecha%notarios.sql
echo.
echo.
echo                    A ocurrido un problema al generar el Backup
echo                       es necesario correrlo de forma manual.
goto FIN
:VALID
Winrar a C:\Doc_Generados\backup\%fecha%notarios.rar C:\Doc_Generados\backup\%fecha%notarios.sql
DEL C:\Doc_Generados\backup\%fecha%notarios.sql
echo.
echo.
echo            Se genero satisfactoriamente el backup de la BD del SISNOT
echo.
@ECHO.           %date:~0,2%-%date:~3,2%-%date:~6,4% a las %time:~0,5%  con nombre %fecha%notarios.sql
:FIN
pause>nul
exit





