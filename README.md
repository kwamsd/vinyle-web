Il faut :
```bash
sudo nano /etc/apache2/sites-available/000-default.conf
```
Puis
```
# chemin absolu du dossier
<Directory /var/www/html/crepe_waou/public>
    AllowOverride All
</Directory>
```