-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 04 Jun 2011 om 18:18
-- Serverversie: 5.1.44
-- PHP-Versie: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skeleton`
--

--
-- Gegevens worden uitgevoerd voor tabel `acl_privileges`
--

INSERT INTO `acl_privileges` VALUES(1, 'auth', 'account', 'index', 'Watch Profile Information');
INSERT INTO `acl_privileges` VALUES(2, 'auth', 'account', 'update', 'Update Profile Information');
INSERT INTO `acl_privileges` VALUES(3, 'default', 'index', 'index', 'Homepage');
INSERT INTO `acl_privileges` VALUES(4, 'auth', 'password', 'forgot', 'Forgot Password');
INSERT INTO `acl_privileges` VALUES(5, 'auth', 'register', 'index', 'Able to register');
INSERT INTO `acl_privileges` VALUES(6, 'auth', 'login', 'index', 'View Login Form');
INSERT INTO `acl_privileges` VALUES(7, 'default', 'error', 'error', 'View Error Page');
INSERT INTO `acl_privileges` VALUES(8, 'auth', 'account', 'event', 'View Event List');
