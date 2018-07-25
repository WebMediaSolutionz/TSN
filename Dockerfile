FROM httpd:2.4

LABEL author="Maxime Pierre <max@webmediasolutionz.com>"

WORKDIR /usr/local/apache2/htdocs/

COPY ./web/ .

EXPOSE 80 443