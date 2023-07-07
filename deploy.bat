
set src=C:\Code\catalogorgua
set dst=sen@sen.ftp.tools:/home/sen/catalog.org.ua/www

ssh sen@sen.ftp.tools cd catalog.org.ua; cd www; rm -r migrations; rm -r src; rm -r templates;  rm -r translations;

scp -r %src%\bin %dst%
scp -r %src%\config %dst%
scp -r %src%\migrations %dst%
scp -r %src%\public %dst%
scp -r %src%\src %dst%
scp -r %src%\templates %dst%
scp -r %src%\translations %dst%

scp %src%\.env %dst%
scp %src%\.env.test %dst%
scp %src%\.gitignore %dst%
scp %src%\Catalog.org.ua %dst%
scp %src%\composer.json %dst%
scp %src%\composer.lock %dst%
scp %src%\deployment.txt %dst%
scp %src%\docker-compose.override.yml %dst%
scp %src%\docker-compose.yml %dst%
scp %src%\phpunit.xml.dist %dst%
scp %src%\symfony.lock %dst%
scp %src%\deploy.bat %dst%

ssh sen@sen.ftp.tools cd catalog.org.ua; cd www; php bin/console cache:clear;