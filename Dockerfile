FROM httpd:2.4

LABEL author="Maxime Pierre <max@webmediasolutionz.com>"

WORKDIR /usr/src/myapp

COPY ./web/ .

EXPOSE 80 443