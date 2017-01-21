-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2016 at 03:37 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `masomo`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddAnswers`(IN `answer` TEXT, IN `Question` TEXT)
BEGIN
declare QuestionId int;
set QuestionId=(select questions.QId from questions where questions.Question=Question);
insert into answers values("",answer,QuestionId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddCorrectAnswer`(IN `correct` TEXT, IN `Question` TEXT)
BEGIN
declare QuestionId int;
set QuestionId=(select questions.QId from questions where questions.Question=Question);
insert into correctanswers values("",correct,QuestionId);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddMembers`(IN `userid` INT, IN `groupname` TEXT)
BEGIN
declare groupid int;
set groupid=(select `group`.GId from `group` where `group`.Name=groupname);
insert into members values("",userid,groupid);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddQuestion`(IN `subject` VARCHAR(200), IN `question` TEXT, IN `class` VARCHAR(100))
BEGIN
declare subId Int;
set subId=(select subjects.SId from subjects where subjects.Subject=subject);
insert into questions values("",question,subId,class);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_AddSubject`(IN `subject` VARCHAR(200))
BEGIN
Insert into subjects values("",subject);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_checkCorrectAnswer`(IN `Qid` INT, IN `Aid` INT)
BEGIN
declare correct text;
set correct=(select answers.Answer from answers where answers.AId=Aid);
select *  from correctanswers where correctanswers.CorrectAnswer=correct and correctanswers.QId=Qid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CheckGroup`(IN `name` TEXT)
BEGIN
select * from `group` where `group`.Name=name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CheckSubject`(IN `subject` VARCHAR(200))
BEGIN
select * from subjects where subjects.Subject=subject;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CheckUser`(IN `email` VARCHAR(200))
BEGIN
Select * from users where users.Email=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_CreateGroup`(IN `name` TEXT, IN `description` TEXT, IN `createdby` INT)
BEGIN
insert into `group` values("",name,description,createdby);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getAnswersTest`(IN `questionId` INT)
BEGIN
select * from answers where answers.QId=questionId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCorrectAnswer`(IN `qid` INT)
BEGIN
Select correctanswers.CorrectAnswer from correctanswers where correctanswers.QId=qid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCountQuestionsDone`(IN `userid` INT)
BEGIN
select distinct(questions.Subject), count(questionsdone.QId) as Qnumber from questions inner join questionsdone on questions.QId=questionsdone.QId where questionsdone.UserId=userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getCreatedGroups`(IN `createdBy` INT)
BEGIN
select * from `group` where `group`.CreatedBy=createdBy;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getJoinedGroup`(IN `userid` INT)
BEGIN
select `group`.Name from members inner join `group` on `group`.GId=members.`group` where members.UserId=userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getQuestionRevision`(IN `subject` VARCHAR(200), IN `class` VARCHAR(100))
BEGIN
declare subjectId int;
set subjectId=(select subjects.SId from subjects where subjects.Subject=subject);
select questions.QId,questions.Question,questions.Subject from questions inner join questionsdone on questions.QId=questionsdone.QId
where questions.Subject=subjectId and questionsdone.Revision='Check' and questions.Class=class order by rand() limit 0,1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getQuestions`()
BEGIN
select questions.QId,questions.Question,questions.Class,subjects.Subject from questions 
inner join subjects on subjects.SId=questions.Subject order by questions.Class;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getQuestionTest`(IN `subject` VARCHAR(200), IN `class` VARCHAR(100), IN `id` INT)
BEGIN
declare subjectId int;
set subjectId=(select subjects.SId from subjects where subjects.Subject=subject);
Create temporary table testView
select * from questionsdone where questionsdone.UserId=id;
select questions.QId,questions.Question,questions.Subject from questions left outer join testView on questions.QId=testView.QId
where testView.QId is null and questions.Subject=subjectId and questions.Class=class order by rand() limit 0,1;
drop temporary table testView;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetRevisionSubject`(IN `subjectid` INT)
BEGIN
select subjects.Subject from subjects where subjects.SId=subjectid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getSubjectRevision`(IN `UserId` INT)
BEGIN
select distinct(questions.Subject) from questions inner join questionsdone on questions.QId=questionsdone.QId where questionsdone.UserId=UserId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetSubjects`()
BEGIN
select * from subjects;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getUsers`()
BEGIN
select * from users;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertDoneQuestion`(IN `userid` INT, IN `Qid` INT, IN `Aid` INT)
BEGIN
insert into questionsdone value ("",Qid,Aid,userid,"Check");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_InsertUser`(IN `fname` VARCHAR(100), IN `lname` VARCHAR(100), IN `pass` TEXT, IN `email` VARCHAR(200), IN `phone` VARCHAR(20), IN `question` TEXT, IN `ans` TEXT)
BEGIN
insert into users values("",fname,lname,phone,email,pass,question,ans);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_LogIn`(IN `email` VARCHAR(200), IN `pass` TEXT)
BEGIN
Select * from users where users.Email=email and users.Password=pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_temp`(IN `id` INT, IN `class` VARCHAR(100))
BEGIN
Create temporary table testView
select * from questionsdone where questionsdone.UserId=id;
select questions.QId,questions.Question,questions.Subject from questions inner join testView on questions.QId=testView.QId
where (testView.QId is null) or testView.UserId!=id and questions.Class=class order by rand() limit 0,1;
drop temporary table testView;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateRevisedQuestionsCheck`(IN `userid` INT)
BEGIN
update questionsdone set questionsdone.Revision="Check" where questionsdone.UserId=userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateRevisedQuestionsDone`(IN `Qid` INT)
BEGIN
update questionsdone set questionsdone.Revision="done" where questionsdone.QId=Qid;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `AId` int(11) NOT NULL AUTO_INCREMENT,
  `Answer` text NOT NULL,
  `QId` int(11) NOT NULL,
  PRIMARY KEY (`AId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`AId`, `Answer`, `QId`) VALUES
(5, 'Uhuru', 2),
(6, 'Ruto', 2),
(7, 'Raila', 2),
(8, 'Kalonzo', 2),
(9, 'there are too many vehicles in the country', 3),
(10, 'the roads are used by many pedestrians', 3),
(11, 'many drivers ignore traffic rules', 3),
(12, 'many roads in the country are narrow', 3),
(13, 'Direction of sound', 4),
(14, 'Effects of sound pollution', 4),
(15, 'Loud and soft sounds', 4),
(16, 'Meaning of special sounds', 4),
(17, 'Formation of shadows', 5),
(18, 'Uses of light', 5),
(19, 'Sources of light', 5),
(20, 'How light travels', 5),
(21, 'Saw dust and artificial fertilizer', 6),
(22, 'Plastics and artificial fertilizer', 6),
(23, 'Wood ash and saw dust', 6),
(24, 'Plastics and iron filings ', 6),
(33, 'Newspapers', 8),
(34, 'Email', 8),
(35, 'Telephone', 8),
(36, 'Television ', 8);

-- --------------------------------------------------------

--
-- Table structure for table `correctanswers`
--

CREATE TABLE IF NOT EXISTS `correctanswers` (
  `CAId` int(11) NOT NULL AUTO_INCREMENT,
  `CorrectAnswer` text NOT NULL,
  `QId` int(11) NOT NULL,
  PRIMARY KEY (`CAId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `correctanswers`
--

INSERT INTO `correctanswers` (`CAId`, `CorrectAnswer`, `QId`) VALUES
(2, 'Uhuru', 2),
(3, 'many drivers ignore traffic rules', 3),
(4, 'Direction of sound', 4),
(5, 'How light travels', 5),
(6, 'Plastics and artificial fertilizer', 6),
(9, 'Newspapers', 8);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `GId` int(11) NOT NULL AUTO_INCREMENT,
  `Name` text NOT NULL,
  `Description` text NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  PRIMARY KEY (`GId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`GId`, `Name`, `Description`, `CreatedBy`) VALUES
(2, 'Scholars', 'Masomo Revision Corner.\r\n                    ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `MId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`MId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`MId`, `UserId`, `group`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QId` int(11) NOT NULL AUTO_INCREMENT,
  `Question` text NOT NULL,
  `Subject` varchar(100) NOT NULL,
  `Class` varchar(100) NOT NULL,
  PRIMARY KEY (`QId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QId`, `Question`, `Subject`, `Class`) VALUES
(2, 'Who is the president of Kenya?\r\n                    ', '3', 'Class 6'),
(3, 'The main reason why there are many accidents in the country is because      ', '3', 'Class 7'),
(4, 'A pupil was blindfolded and asked to listen as a bell was rang from different positions. Which aspect of sound was being investigated?\r\n\r\n                    ', '1', 'Class 8'),
(5, 'In a certain investigation pupils used a straight pipe to observe a candle flame.They then bent the pipe and observed again.Which aspect of light was being investigated?\r\n\r\n                    ', '1', 'Class 8'),
(6, 'Which one of the following pairs of materials will pollute soil?\r\n                    ', '1', 'Class 6'),
(8, 'Three of the following are electronic media.Which one is not?\r\n\r\n                    ', '3', 'Class 6');

-- --------------------------------------------------------

--
-- Table structure for table `questionsdone`
--

CREATE TABLE IF NOT EXISTS `questionsdone` (
  `DId` int(11) NOT NULL AUTO_INCREMENT,
  `QId` int(11) NOT NULL,
  `AId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Revision` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`DId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `questionsdone`
--

INSERT INTO `questionsdone` (`DId`, `QId`, `AId`, `UserId`, `Revision`) VALUES
(1, 4, 16, 2, 'Check'),
(8, 2, 5, 3, 'Check'),
(10, 6, 24, 2, 'Check'),
(23, 8, 33, 2, 'Check'),
(24, 2, 5, 2, 'Check');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `SId` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(200) NOT NULL,
  PRIMARY KEY (`SId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SId`, `Subject`) VALUES
(1, 'Science'),
(3, 'Social Studies');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(100) NOT NULL,
  `SecondName` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` text NOT NULL,
  `Question` text,
  `Ans` text,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `FirstName`, `SecondName`, `Phone`, `Email`, `Password`, `Question`, `Ans`) VALUES
(2, 'Lydia', 'Nthenya', '0718967169', 'lydia@masomo.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Whats my name?', 'Lydia'),
(3, 'Lydia', 'Nthenya', '0718488944', 'nthenya@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL),
(4, 'Test', 'Pupil', '0734567456', 'lydianthenya26@gmail.com', '01cfcd4f6b8770febfb40cb906715822', NULL, NULL),
(5, 'Ann', 'Kamau', '07946519', 'ann@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Whats my second name?', 'Kamau');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
