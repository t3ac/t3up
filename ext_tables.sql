#
# Table structure for table 'pages'
#
CREATE TABLE pages (
    showtitle int(11) DEFAULT '0' NOT NULL,
    deltitle int(11) DEFAULT '0' NOT NULL,    
    breadcrumb int(11) DEFAULT '0' NOT NULL,  
    hidenav int(11) DEFAULT '0' NOT NULL,
    nonav int(11) DEFAULT '0' NOT NULL,
    previousnext int(11) DEFAULT '0' NOT NULL,
	basecolor varchar(60) DEFAULT '' NOT NULL
);


CREATE TABLE tt_content (
    padding_before_class varchar(60) DEFAULT '' NOT NULL,
    padding_after_class varchar(60) DEFAULT '' NOT NULL,
    padding_side_class varchar(60) DEFAULT '' NOT NULL,
    padding_inner_class varchar(60) DEFAULT '' NOT NULL,
    lightboxstyle varchar(60) DEFAULT '' NOT NULL,  
    inf smallint(5)  DEFAULT '0' NOT NULL,
    rollover smallint(5)  DEFAULT '0' NOT NULL, 
    spacing varchar(60)  DEFAULT '' NOT NULL, 
    container int(11) DEFAULT '0' NOT NULL,
    objectfit int(11) DEFAULT '0' NOT NULL, 
    bgimage  int(11),
    bgcolor varchar(255),
    txtcolor varchar(255)
);


ALTER TABLE `tt_content` CHANGE `layout` `layout` VARCHAR(60) NOT NULL; 
