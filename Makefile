
####### VARS #######

include .env
export $(shell sed 's/=.*//' .env)

ifeq ($(APP_ENV), production)
 TYPE_ENV := prod
else
 TYPE_ENV := dev
endif

####### DOCKER #######

docker-up:
	docker compose up -d ${service}

up: docker-up


null:
	docker compose build --no-cache

docker-stop:
	docker compose  stop ${service}

docker-down:
	docker compose  down

down: docker-down

docker-build:
	docker compose  up --build -d ${service}

build: docker-build


php:
	docker compose  exec spt-cli bash

