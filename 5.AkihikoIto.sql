-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 09 日 08:56
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `ai_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `song1` varchar(128) NOT NULL,
  `song2` varchar(128) NOT NULL,
  `song3` varchar(128) NOT NULL,
  `comment` text NOT NULL,
  `mail` varchar(128) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `name`, `song1`, `song2`, `song3`, `comment`, `mail`, `date`) VALUES
(1, 'test', ' Prism', ' SOS!', ' SOS! - instrumental', 'ああああ', 'test@gmail.com', '2020-12-31 08:42:39'),
(2, 'test', ' Hikari - piano TV ver.', ' Joker', ' SOS!', 'ああああああ\r\nああああ\r\nああああああ', 'test@gmail.com', '2020-12-31 13:11:20'),
(3, 'test', ' AM0:40', ' Arigato', ' Astra Nova', '全曲表示できた', 'test', '2020-12-31 18:53:09'),
(4, 'いとうあきひこ', ' Tonbi', ' Paranoid', ' Lit', 'てすとです', 'akihiko19860807@gmail.com', '2021-01-04 14:13:42'),
(5, '伊藤彬彦', ' Under The Sun', ' Tonbi', ' Catch Me', 'てすとてすと', 'akihiko19860807@hotmail.com', '2021-01-04 14:27:00'),
(6, 'てすとです', ' Alpha', ' Kaonashi', ' Tonbi', 'フェードインするようにしたり色々', 'test@gmail.com', '2021-01-06 16:43:16'),
(17, 'aaa', ' Yurariri', ' RainMan', ' Youth', '', 'aaa@gmail.com', '2021-01-08 18:41:52'),
(18, 'test', ' Bell', ' RDM', ' Boohoo', '必須項目含んだフォームにどうにかなったような気がする', 'test@gmail.com', '2021-01-09 02:26:31');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
