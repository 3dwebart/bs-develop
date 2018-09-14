DROP TABLE IF EXISTS `g5_languageSet`;
CREATE TABLE IF NOT EXISTS `g5_languageSet` (
  `id`                 INT             NOT NULL AUTO_INCREMENT                COMMENT '일련번호',
  `languageCode`       char(10)        NOT NULL                               COMMENT '언어코드',
  `currentLanguage`    char(128)       NOT NULL                               COMMENT '현재언어',
  `langKor`            char(128)       NOT NULL                               COMMENT '한국어',
  `langEng`            char(128)       NOT NULL                               COMMENT '영어',
  `langZhh`            char(128)       NOT NULL                               COMMENT '중국어(간체)',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET `UTF8` COMMENT='언어';

INSERT INTO `g5_languageSet` (`languageCode`, `currentLanguage`, `langKor`, `langEng`, `langZhh`)
VALUES 
('ko', '한국어', '한국어', '영어', '중국어'),
('en', 'english', 'korean', 'english', 'chanese(Simplified)'),
('zh-hans', '한국어', 'korean', 'english', 'chanese(Simplified)');