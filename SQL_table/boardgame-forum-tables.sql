-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 oct. 2020 à 17:19
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

use boardgame-forum;


CREATE TABLE `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `publisher` char(255) NOT NULL,
  `price` float NOT NULL,
  `image` blob NOT NULL
);



CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `score` int(11) NOT NULL,
  `comment` varchar(4000) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT current_timestamp()
  FOREIGN KEY (id_user) REFERENCES user(id)
  FOREIGN KEY (id_game) REFERENCES game(id)
);


CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `pseudonym` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `profile_picture` blob NOT NULL,
    `country` varchar(255),
    `birthdate` date NOT NULL,
    `date_account_creation` datetime NOT NULL DEFAULT current_timestamp,

);

CREATE TABLE `follows`(
    `id_user` int(11) NOT NULL,
    `id_friend` int(11) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_friend) REFERENCES user(id)
);

CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `country_name` varchar(255) NOT NULL
);


CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `tag_name` varchar(255) NOT NULL
);

CREATE TABLE `relation_tag`(
    `id_game` int(11) NOT NULL,
    `id_tag` int(11) NOT NULL,
    FOREIGN KEY (id_game) REFERENCES game(id),
    FOREIGN KEY (id_tag) REFERENCES tag(id)
);

CREATE TABLE `vote`(
    `id_user` int(11) NOT NULL,
    `id_review` int(11) NOT NULL,
    `positive` boolean NOT NULL,
    FOREIGN KEY (id_user) REFERENCES user(id),
    FOREIGN KEY (id_review) REFERENCES review(id)
);
