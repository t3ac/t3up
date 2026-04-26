#
# Table structure for table 'pages'
#
CREATE TABLE pages (
    showtitle tinyint(1) DEFAULT '0' NOT NULL,
    deltitle tinyint(1) DEFAULT '0' NOT NULL,    
    breadcrumb tinyint(1) DEFAULT '0' NOT NULL,  
    hidenav tinyint(1) DEFAULT '0' NOT NULL,
    nonav tinyint(1) DEFAULT '0' NOT NULL,
    previousnext tinyint(1) DEFAULT '0' NOT NULL,
    basecolor varchar(60) DEFAULT '' NOT NULL,
    xtraclass varchar(60) DEFAULT '' NOT NULL
);


CREATE TABLE tt_content (
    padding_before_class varchar(60) DEFAULT '' NOT NULL,
    padding_after_class varchar(60) DEFAULT '' NOT NULL,
    padding_side_class varchar(60) DEFAULT '' NOT NULL,
    padding_inner_class varchar(60) DEFAULT '' NOT NULL,
    animate varchar(60) DEFAULT '' NOT NULL,
    animate_duration varchar(60) DEFAULT '' NOT NULL,
    animate_easing varchar(60) DEFAULT '' NOT NULL,
    animate_delay varchar(60) DEFAULT '' NOT NULL,    
    lightboxstyle varchar(60) DEFAULT '' NOT NULL,  
    inf smallint(5)  DEFAULT '0' NOT NULL,
    rollover smallint(5)  DEFAULT '0' NOT NULL, 
    spacing varchar(60)  DEFAULT '' NOT NULL, 
    container tinyint(1) DEFAULT '0' NOT NULL,
    objectfit tinyint(1) DEFAULT '0' NOT NULL, 
    bgimage  tinyint(1),
    bgcolor varchar(255),
    txtcolor varchar(255)
);


ALTER TABLE `tt_content` CHANGE `layout` `layout` VARCHAR(60) NOT NULL; 
