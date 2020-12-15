-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 15 2020 г., 12:10
-- Версия сервера: 5.7.25
-- Версия PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat_youtube`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `message` tinytext NOT NULL,
  `user` varchar(20) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `message`, `user`, `time`) VALUES
(120, 'fddfdfdfdf', 'Абдушакур', '2020-09-13 11:34:15');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `material` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `added` varchar(20) NOT NULL,
  `text` tinytext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `material`, `module`, `added`, `text`, `date`) VALUES
(8, 122, 1, '0000', 'Ocenil', '2020-09-11 15:28:49'),
(7, 1, 2, '0000', 'производитель высокотехнологичных компонентов, включая полноцикловое производство интегральных микросхем', '2020-09-23 03:12:19'),
(9, 28, 1, '0000', 'Просомтров: 1 | Добавил: Admin | Оценок: 18 | Дата: 2015-03-06 18:57:30 | Редактировать новость | Удалить новость', '2020-09-11 15:31:53');

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `send` int(11) NOT NULL,
  `recive` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`id`, `status`, `send`, `recive`) VALUES
(5, 0, 3, 2),
(2, 1, 2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `close` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `author` varchar(20) NOT NULL,
  `last_post` varchar(20) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forum`
--

INSERT INTO `forum` (`id`, `section`, `date`, `close`, `name`, `author`, `last_post`, `last_update`) VALUES
(1, 1, '2020-09-01 00:00:00', 0, 'Основы ООП', '0000', '3333', '2020-09-16 10:23:51'),
(2, 2, '2020-09-07 00:00:00', 0, 'Выражения в PHP', '0000', '3333', '2020-09-16 10:23:51'),
(3, 2, '2020-09-07 00:00:00', 0, 'Логические выражения', '0000', '3333', '2020-09-16 10:23:51');

-- --------------------------------------------------------

--
-- Структура таблицы `forump`
--

CREATE TABLE `forump` (
  `id` int(11) NOT NULL,
  `topic` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `author` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `forump`
--

INSERT INTO `forump` (`id`, `topic`, `date`, `text`, `author`) VALUES
(1, 1, '2020-09-16 10:04:12', 'В последнее время идея объектно-ориентированного программирования (ООП), кардинально новая идеология написания программ, все более занимает умы программистов.', '0000'),
(2, 1, '2020-09-16 10:04:21', 'Объектно-ориентированные программы более просты и мобильны, их легче модифицировать и сопровождать, чем их \"традиционных\" собратьев. Кроме того, похоже, сама идея объектной ориентированности при грамотном ее использовании позволяет программе быть даже более защищенной от различного рода ошибок, чем это задумывал программист в момент работы над ней. Однако ничего не дается даром: сами\r\nидеи ООП довольно трудны для восприятия \"с нуля\", поэтому до сих пор очень большое количество программ (различные системы Unix, Apache, Perl, да и сам PHP) все еще пишутся на старом добром \"объектно-неориентированном\" Си.', '0000'),
(3, 3, '2020-09-16 10:07:12', 'Логические выражения — это выражения, у которых могут быть только два значения: ложь и истина (или, что почти то же самое, 0 и 1). Однако, если говорить более строго, то абсолютно любое выражение может рассматриваться как логическое в \"логическом\" контексте (например, как условие для конструкции if-else). Ведь в качестве TRUE (истины) может выступать любое ненулевое число, непустая строка и т. д., а под FALSE (ложью) подразумевается все остальное.\r\nДля логических выражений справедливы все свойства логических переменных. Эти выражения чаще всего возникают при применении операторов >, < и == (равно), || (логическое ИЛИ), && (логическое И), ! (логическое НЕ) и других. Например:', '0000'),
(4, 2, '2020-09-16 10:07:26', 'Выражения - это краеугольный камень PHP. Почти все, что вы пишите в PHP, является выражением. Выражения являются \"кирпичиками\", из которых состоят PHP-программы. Под выражением в PHP понимается то, что имеет значение. И обратно: если что-то имеет значение, то это \"что-то\" и есть выражение.', '0000');

-- --------------------------------------------------------

--
-- Структура таблицы `loads`
--

CREATE TABLE `loads` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `cat` int(11) NOT NULL,
  `added` varchar(20) NOT NULL,
  `text` mediumtext NOT NULL,
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `dimg` int(11) NOT NULL,
  `dfile` int(11) NOT NULL,
  `link` tinytext NOT NULL,
  `rate` int(11) NOT NULL,
  `rateusers` mediumtext NOT NULL,
  `download` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `loads`
--

INSERT INTO `loads` (`id`, `name`, `cat`, `added`, `text`, `date`, `active`, `dimg`, `dfile`, `link`, `rate`, `rateusers`, `download`) VALUES
(5, 'Fool Text', 1, '0000', 'производитель высокотехнологичных компонентов, включая полноцикловое производство интегральных микросхем', '2020-09-08 20:04:38', 1, 1, 0, 'http://chat.php/loads/add', 14, '0,3', 0),
(4, 'Compyter23', 1, '0000', 'WWW про', '2020-09-08 20:03:46', 1, 1, 1, '0', 13, '0', 3),
(3, 'Dulhtar', 1, '0000', 'производитель ', '2020-08-31 14:32:26', 1, 1, 1, '0', 73, '0,3', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `did`, `user`, `text`, `date`) VALUES
(4, 2, 7, 'Абдураҳмон', '2020-09-12 11:54:08'),
(11, 2, 2, 'MRO', '2020-09-12 12:45:33'),
(10, 2, 7, 'Abdurahmon', '2020-09-12 12:45:10'),
(9, 2, 2, 'MAR', '2020-09-12 12:03:50'),
(12, 2, 2, 'MOR', '2020-09-12 12:45:56'),
(15, 5, 3, '123456789', '2020-09-13 09:30:31');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `cat` int(11) NOT NULL,
  `added` varchar(20) NOT NULL,
  `text` tinytext NOT NULL,
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `rate` int(11) NOT NULL,
  `rateusers` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `cat`, `added`, `text`, `date`, `active`, `rate`, `rateusers`) VALUES
(119, 'OK АМО ТДЖ', 1, '0000', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2020-08-14 14:23:45', 1, 23, '0'),
(28, 'Инро ман тағир додам братшка', 3, 'Admin', 'текст.... 1111', '2015-03-06 18:57:30', 1, 18, ',3'),
(120, 'Мохтоб мурд!', 1, '0000', ':( - ВАЙ ВАЙ ВАЙ &lt;br&gt;', '2020-08-17 11:14:41', 1, 34, '0'),
(122, 'Man JONON', 1, '123456789', '111111111111111', '2020-08-19 10:52:54', 1, 82, '0,3');

-- --------------------------------------------------------

--
-- Структура таблицы `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `text` text NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notice`
--

INSERT INTO `notice` (`id`, `uid`, `status`, `date`, `text`, `title`) VALUES
(1, 3, 1, '2020-09-11 00:00:00', 'Технология push-уведомлений – это новый маркетинговый канал для коммуникации с клиентами. Push-рассылка обладает рядом уникальных характеристик, не свойственных никакому другому маркетинговому инструменту. ', 'Как сделать push'),
(2, 3, 1, '2020-09-16 00:00:00', 'Это делает «пуши» чрезвычайно привлекательной технологией, которую активно продвигает компания Google, а поддерживают все популярные платформы.', 'Как включить или отключить оповещения для всех веб-сайтов'),
(3, 3, 1, '2020-09-08 00:00:00', 'Владельцы сайтов все чаще задумываются о подключении push-уведомлений, однако здесь возникает множество вопросов. ', 'Отправляйте web push сообщения посетителям своего сайта бесплатно.');

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE `online` (
  `user` varchar(20) NOT NULL,
  `ip` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `online`
--

INSERT INTO `online` (`user`, `ip`, `time`) VALUES
('0000', '127.0.0.1', '2020-12-09 12:04:26');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `amount` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `login`, `amount`) VALUES
(2, 'MrShift', 10),
(3, 'MrShift', 100.72);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `regdate` datetime NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `avatar` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `regdate`, `email`, `country`, `avatar`, `active`, `group`) VALUES
(2, '123456789', '74583e64e50b87b60f7cb24a6d3b3e7b', 'Мархабо', '2020-04-13 00:00:00', 'abs@ro.ru', 0, 1, 1, 1),
(3, '0000', '9fac9d71f80170c05f8bd10fed1a9629', 'Абдушакур', '2020-04-13 00:00:00', 'wevf@bgn.tru', 4, 1, 1, 2),
(4, '121212', '8b1ba4d888d97cfb19bf94c0095d1e95', 'Хакер', '2020-04-13 00:00:00', 'okok@mail.ru', 2, 1, 1, -1),
(5, '112233', 'b1959bae31a29d8ce442adb0d10d4e67', 'Абдушакур', '2020-09-09 11:19:55', 'abs@gmail.com', 0, 0, 0, 0),
(6, '985060681', 'b3a966496463df698d1d475a3a30a813', 'Хакер', '2020-09-15 00:00:00', 'Hak@mail.ru', 0, 0, 1, 1),
(7, '3333', 'ba9ef7cd86b5a18d66ff550833c87b68', 'Абдурахмон', '2020-09-11 08:14:42', 'www111@mail.ru', 0, 1, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `forump`
--
ALTER TABLE `forump`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `loads`
--
ALTER TABLE `loads`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `dialog`
--
ALTER TABLE `dialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `forump`
--
ALTER TABLE `forump`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `loads`
--
ALTER TABLE `loads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT для таблицы `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
