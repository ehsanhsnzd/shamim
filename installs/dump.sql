

CREATE TABLE `affiliates_settings` (
  `id` int(11) NOT NULL auto_increment,
  `param` varchar(100) default NULL,
  `meaning` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `affiliates_settings` VALUES(1, 'Buyer signup commission', '15');
INSERT INTO `affiliates_settings` VALUES(2, 'Seller signup commission', '10');



CREATE TABLE `affiliates_signups` (
  `userid` int(11) default NULL,
  `types` varchar(50) default NULL,
  `types_id` int(11) default NULL,
  `rates` float default NULL,
  `total` float default NULL,
  `data` int(11) default NULL,
  `aff_referal` int(11) default NULL,
  `status` tinyint(4) default NULL,
  `description` text,
  `gateway` varchar(50) default NULL,
  KEY `userid` (`userid`),
  KEY `types` (`types`),
  KEY `types_id` (`types_id`),
  KEY `total` (`total`),
  KEY `data` (`data`),
  KEY `aff_referal` (`aff_referal`),
  KEY `status` (`status`)
);



INSERT INTO `affiliates_signups` VALUES(6355, 'subscription', 22, 15, 1.5, 1373815943, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 132, 15, 1.35, 1351948360, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 131, 15, 1.35, 1351948373, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'subscription', 21, 15, 1.5, 1351434542, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 28, 15, 0.15, 1312624808, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 27, 15, 0.15, 1312624378, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(0, 'refund', 0, 0, -1, 1301676718, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 99, 15, 0, 1337343807, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'orders', 119, 15, 0.15, 1345648846, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 137, 15, 0.15, 1351948337, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 136, 15, 0.15, 1351948338, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 150, 15, 0.15, 1355489185, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'subscription', 26, 15, 1.5, 1355489279, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'orders', 123, 15, 0.15, 1355489371, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(0, 'refund', 0, 0, -1, 1362830880, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(0, 'refund', 0, 0, -1, 1376826211, 7292, 0, '\nVTB24: 1234-5678-1234-56781', 'bank');
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 185, 15, 0.15, 1362832884, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 197, 15, 0.15, 1365838033, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 198, 15, 0.15, 1365838197, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(6355, 'credits', 199, 15, 0.15, 1365838297, 7292, 1, NULL, NULL);
INSERT INTO `affiliates_signups` VALUES(0, 'refund', 0, 0, -1, 1376826328, 7292, 0, '', 'other');



CREATE TABLE `affiliates_stats` (
  `userid` int(11) default NULL,
  `seller` int(11) default NULL,
  `buyer` int(11) default NULL,
  `data` int(11) default NULL,
  `ip` varchar(100) default NULL,
  `aff_referal` int(11) default NULL,
  KEY `userid` (`userid`),
  KEY `seller` (`seller`),
  KEY `buyer` (`buyer`),
  KEY `data` (`data`),
  KEY `aff_referal` (`aff_referal`)
);



INSERT INTO `affiliates_stats` VALUES(6355, 0, 1, 1301644908, '127.0.0.1', 7292);
INSERT INTO `affiliates_stats` VALUES(3931, 1, 0, 1301645011, '127.0.0.1', 7292);



CREATE TABLE `audio` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `description` text,
  `keywords` varchar(200) default NULL,
  `author` varchar(50) default NULL,
  `data` int(11) default NULL,
  `viewed` int(11) default NULL,
  `published` tinyint(1) default NULL,
  `featured` tinyint(1) default NULL,
  `userid` int(11) default NULL,
  `folder` varchar(50) default NULL,
  `holder` varchar(50) default NULL,
  `source` varchar(50) default NULL,
  `format` varchar(50) default NULL,
  `duration` int(10) default NULL,
  `content_type` varchar(50) default NULL,
  `free` tinyint(1) default NULL,
  `downloaded` int(11) default NULL,
  `rating` float default NULL,
  `model` int(10) default NULL,
  `server1` int(11) default NULL,
  `server2` int(11) default NULL,
  `server3` tinyint(1) default NULL,
  `examination` tinyint(1) default NULL,
  `category2` int(11) default NULL,
  `category3` int(11) default NULL,
  `google_x` double default NULL,
  `google_y` double default NULL,
  `refuse_reason` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `adult` tinyint(4) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`),
  KEY `title` (`title`),
  KEY `published` (`published`),
  KEY `featured` (`featured`),
  KEY `viewed` (`viewed`),
  KEY `downloaded` (`downloaded`),
  KEY `author` (`author`),
  KEY `userid` (`userid`),
  KEY `free` (`free`),
  KEY `rating` (`rating`),
  KEY `examination` (`examination`),
  KEY `category2` (`category2`),
  KEY `category3` (`category3`),
  KEY `google_x` (`google_x`),
  KEY `google_y` (`google_y`),
  KEY `server1` (`server1`),
  KEY `server2` (`server2`),
  KEY `duration` (`duration`),
  KEY `adult` (`adult`)
);



INSERT INTO `audio` VALUES(7658, 'Waxwing', 'The bird sings.', 'bird,sing', 'common', 1361096227, 29, 1, 0, 0, '7658', 'John Smith', 'MP3', 'Stereo', 23, 'Common', 0, 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 0, 0, NULL, '/stock-audio/waxwing-7658.html', 0);
INSERT INTO `audio` VALUES(7657, 'Yellowhammer', 'The yellowhammer sings.', 'bird,sing', 'common', 1361096017, 8, 1, 0, 0, '7657', 'John Smith', 'MP3', 'Stereo', 22, 'Common', 0, 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 0, 0, NULL, '/stock-audio/yellowhammer-7657.html', 0);



CREATE TABLE `audio_fields` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `priority` int(11) default NULL,
  `activ` int(11) default NULL,
  `required` int(11) default NULL,
  `always` int(11) default NULL,
  `fname` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
);


INSERT INTO `audio_fields` VALUES(1, 'category', 1, 1, 1, 1, 'folder');
INSERT INTO `audio_fields` VALUES(2, 'title', 2, 1, 1, 1, 'title');
INSERT INTO `audio_fields` VALUES(3, 'description', 3, 1, 1, 0, 'description');
INSERT INTO `audio_fields` VALUES(4, 'keywords', 4, 1, 1, 0, 'keywords');
INSERT INTO `audio_fields` VALUES(5, 'file for sale', 5, 1, 1, 1, 'sale');
INSERT INTO `audio_fields` VALUES(6, 'preview audio', 6, 1, 1, 1, 'previewaudio');
INSERT INTO `audio_fields` VALUES(7, 'preview picture', 7, 1, 1, 1, 'previewpicture');
INSERT INTO `audio_fields` VALUES(9, 'duration', 9, 1, 1, 0, 'duration');
INSERT INTO `audio_fields` VALUES(10, 'track source', 10, 1, 1, 0, 'source');
INSERT INTO `audio_fields` VALUES(11, 'track format', 11, 1, 1, 0, 'format');
INSERT INTO `audio_fields` VALUES(12, 'copyright holder', 12, 1, 1, 0, 'holder');
INSERT INTO `audio_fields` VALUES(13, 'terms and conditions', 13, 1, 1, 0, 'terms');



CREATE TABLE `audio_format` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `audio_format` VALUES(1, 'Mono');
INSERT INTO `audio_format` VALUES(2, 'Stereo');
INSERT INTO `audio_format` VALUES(3, '5.1');
INSERT INTO `audio_format` VALUES(4, '7.1');
INSERT INTO `audio_format` VALUES(5, 'Other');



CREATE TABLE `audio_source` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `audio_source` VALUES(1, 'Wav');
INSERT INTO `audio_source` VALUES(2, 'MP3');
INSERT INTO `audio_source` VALUES(4, 'Other');



CREATE TABLE `audio_types` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `types` varchar(200) default NULL,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `shipped` int(11) default NULL,
  `license` int(10) NOT NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`),
  KEY `license` (`license`)
);



INSERT INTO `audio_types` VALUES(4801, 'MP3', 'mp3', 1, 1, 0, 4583);
INSERT INTO `audio_types` VALUES(4802, 'WAV', 'wav', 2, 2, 0, 4583);
INSERT INTO `audio_types` VALUES(5893, 'Shipped CD', 'shipped', 10, 5, 1, 4583);
INSERT INTO `audio_types` VALUES(6783, 'MP3', 'mp3', 10, 1, 0, 4584);
INSERT INTO `audio_types` VALUES(6784, 'Shipped CD', 'shipped', 100, 3, 1, 4584);
INSERT INTO `audio_types` VALUES(6785, 'WAV', 'wav', 20, 2, 0, 4584);



CREATE TABLE `banks` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `banks` VALUES(1, 'VTB24');
INSERT INTO `banks` VALUES(2, 'Privatbank');



CREATE TABLE `blog` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `content` text,
  `data` int(11) default NULL,
  `user` varchar(200) default NULL,
  `published` int(11) default NULL,
  `photo` varchar(200) default NULL,
  `categories` varchar(200) default NULL,
  `comments` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `published` (`published`),
  KEY `data` (`data`),
  KEY `user` (`user`),
  KEY `categories` (`categories`)
);



INSERT INTO `blog` VALUES(4170, 'Hello world!', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 1194823132, 'demo', 1, '/content/blog/post_4170.jpg', '', 1);
INSERT INTO `blog` VALUES(4174, 'Second post', 'Hi everybody.<br />\r\n<br />\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 1194823891, 'demo', 1, '/content/blog/post_4174.jpg', 'Photo,Video', 1);
INSERT INTO `blog` VALUES(4209, 'My first post', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 1195405355, 'siteowner', 1, '/upload/images/post_4209.jpg', 'Funny', 1);
INSERT INTO `blog` VALUES(4217, 'Second post', 'Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 1195419308, 'siteowner', 1, '/upload/images/post_4217.jpg', 'Jokes', 1);



CREATE TABLE `blog_categories` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `user` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `user` (`user`)
);



INSERT INTO `blog_categories` VALUES(4160, 'Photo', 'demo');
INSERT INTO `blog_categories` VALUES(4163, 'Video', 'demo');
INSERT INTO `blog_categories` VALUES(4215, 'Funny', 'siteowner');
INSERT INTO `blog_categories` VALUES(4216, 'Jokes', 'siteowner');



CREATE TABLE `blog_comments` (
  `id_parent` int(11) NOT NULL auto_increment,
  `user` varchar(200) default NULL,
  `content` text,
  `data` int(11) default NULL,
  `postid` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`),
  KEY `user` (`user`)
);



INSERT INTO `blog_comments` VALUES(4206, 'siteowner', 'Very interesting!', 1195402323, 4174);
INSERT INTO `blog_comments` VALUES(4208, 'siteowner', 'Thank you for your post', 1195403608, 4174);
INSERT INTO `blog_comments` VALUES(4210, 'siteowner', 'My first comment!!!', 1195405410, 4209);
INSERT INTO `blog_comments` VALUES(4213, 'demo', 'My second comment!', 1195408050, 4209);
INSERT INTO `blog_comments` VALUES(4215, 'buyer', 'Fantastic', 1337271333, 4174);



CREATE TABLE `caching` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `time_refresh` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `caching` VALUES(1, 'Header', -1);
INSERT INTO `caching` VALUES(2, 'Footer', -1);
INSERT INTO `caching` VALUES(3, 'Home page', -1);
INSERT INTO `caching` VALUES(4, 'Publication pages', -1);
INSERT INTO `caching` VALUES(5, 'Catalog listing', -1);
INSERT INTO `caching` VALUES(6, 'Home page photo sets', -1);
INSERT INTO `caching` VALUES(7, 'Stats', -1);



CREATE TABLE `carts` (
  `id` int(11) NOT NULL auto_increment,
  `session_id` varchar(200) default NULL,
  `data` int(11) default NULL,
  `user_id` int(11) default NULL,
  `order_id` int(11) default NULL,
  `ip` varchar(50) default NULL,
  `checked` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  KEY `session_id` (`session_id`),
  KEY `data` (`data`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `checked` (`checked`)
);



INSERT INTO `carts` VALUES(87, '1e267ac1233e9c19ec92209e777a65f5', 1376822635, 7440, 152, '127.0.0.1', NULL);
INSERT INTO `carts` VALUES(88, '1e267ac1233e9c19ec92209e777a65f5', 1376838066, 0, 0, '127.0.0.1', NULL);



CREATE TABLE `carts_content` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `item_id` int(11) default NULL,
  `prints_id` int(11) default NULL,
  `publication_id` int(11) default NULL,
  `quantity` int(11) default NULL,
  `option1_id` int(11) default NULL,
  `option1_value` varchar(250) default NULL,
  `option2_id` int(11) default NULL,
  `option2_value` varchar(250) default NULL,
  `option3_id` int(11) default NULL,
  `option3_value` varchar(250) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `item_id` (`item_id`),
  KEY `prints_id` (`prints_id`),
  KEY `publication_id` (`publication_id`)
);



INSERT INTO `carts_content` VALUES(165, 87, 3832, 0, 7471, 1, 0, '', 0, '', 0, '');



CREATE TABLE `category` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `priority` int(11) default NULL,
  `password` varchar(200) default NULL,
  `description` text,
  `photo` varchar(200) default NULL,
  `upload` tinyint(1) default NULL,
  `userid` int(11) default NULL,
  `published` tinyint(1) default NULL,
  `url` varchar(250) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`),
  KEY `title` (`title`)
);



INSERT INTO `category` VALUES(3913, 'Cities', 2, '', 'Amazing city pictures', '/content/categories/category_3913.jpg', 0, NULL, 1, '/category/cities.html');
INSERT INTO `category` VALUES(3914, 'Movies', 3, '', 'Example of video publications', '/content/categories/category_3914.jpg', 1, NULL, 1, '/category/movies.html');
INSERT INTO `category` VALUES(3918, 'Animals', 1, '', 'Different pets', '/content/categories/category_3918.jpg', 1, NULL, 1, '/category/animals.html');
INSERT INTO `category` VALUES(7460, 'Cats', 0, '', 'The best animals', '/content/categories/category_7460.jpg', 0, 0, 1, '/category/cats.html');
INSERT INTO `category` VALUES(7472, 'Architecture', 0, '', 'Bridges, highways, train stations', '/content/categories/category_7472.jpg', 1, 0, 1, '/category/architecture.html');
INSERT INTO `category` VALUES(7473, 'Birds', 0, '', 'Mews and other birds', '/content/categories/category_7473.jpg', 1, 0, 1, '/category/birds.html');
INSERT INTO `category` VALUES(7474, 'Nature', 0, '', 'Beautiful nature photos', '/content/categories/category_7474.jpg', 1, 0, 1, '/category/nature.html');
INSERT INTO `category` VALUES(7712, 'CD collections', 8, '', '', '/content/categories/category_7712.jpg', 1, 0, 1, '/category/cd-collections.html');
INSERT INTO `category` VALUES(4375, 'Sounds', 5, '', 'Examples of audio files', '/content/categories/category_4375.jpg', 1, NULL, 1, '/category/sounds.html');
INSERT INTO `category` VALUES(4377, 'Illustrations', 6, '', 'Example of vector publication', '/content/categories/category_4377.jpg', 1, NULL, 1, '/category/illustrations.html');
INSERT INTO `category` VALUES(6251, 'Flash', 7, '', 'Flash animated effects', '/content/categories/category_6251.jpg', 1, NULL, 1, '/category/flash.html');
INSERT INTO `category` VALUES(7450, 'Firenze', 0, '', 'Toscana photos', '/content/categories/category_7450.jpg', 1, 0, 1, '/category/firenze.html');
INSERT INTO `category` VALUES(7449, 'Venezia', 0, '', 'Palaces, canals, squares', '/content/categories/category_7449.jpg', 1, 0, 1, '/category/venezia.html');



CREATE TABLE `commission` (
  `id` int(11) NOT NULL auto_increment,
  `total` float default NULL,
  `user` int(11) default NULL,
  `orderid` int(11) default NULL,
  `item` int(11) default NULL,
  `publication` int(11) default NULL,
  `types` varchar(20) default NULL,
  `data` int(11) default NULL,
  `gateway` varchar(100) default NULL,
  `description` varchar(250) default NULL,
  `status` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user` (`user`),
  KEY `orderid` (`orderid`),
  KEY `item` (`item`),
  KEY `total` (`total`),
  KEY `status` (`status`)
);


INSERT INTO `commission` VALUES(105, 1.5, 3931, 7294, 1941, 6470, 'photos', 1301593402, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(124, 1.5, 3931, 7305, 1935, 6422, 'photos', 1301659511, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(102, 1.5, 3931, 7177, 1931, 4735, 'photos', 1292993901, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(101, 3.75, 4131, 7177, 957, 4839, 'vector', 1292966406, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(93, 2.25, 3931, 7177, 1965, 6470, 'photos', 1292963901, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(125, 3, 3931, 7305, 1983, 6422, 'photos', 1301659593, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(95, 1.5, 3931, 7177, 1941, 6470, 'photos', 1292965626, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(96, 3, 3931, 7177, 1989, 6470, 'photos', 1292965931, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(97, 0.75, 3931, 7177, 1917, 6470, 'photos', 1292965936, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(98, 3.75, 4131, 7177, 1096, 4815, 'videos', 1292966033, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(106, 1.5, 3931, 7294, 1941, 6470, 'photos', 1301593480, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(107, 2.25, 3931, 7294, 1962, 6446, 'photos', 1301593507, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(108, 2.25, 4131, 7294, 1951, 3988, 'photos', 1301593548, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(109, 3, 3931, 7295, 1983, 6422, 'photos', 1301594184, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(110, 3, 4131, 7295, 1970, 3975, 'photos', 1301594222, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(126, 2.25, 3931, 7305, 1960, 6429, 'photos', 1301659980, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(186, 3.75, 4131, 101, 253, 4839, 'vector', 1321958964, NULL, 'order', 1);
INSERT INTO `commission` VALUES(187, 0.75, 4131, 101, 252, 4817, 'audio', 1321958964, NULL, NULL, 1);
INSERT INTO `commission` VALUES(188, 2.25, 4131, 101, 251, 5041, 'videos', 1321958964, NULL, NULL, 1);
INSERT INTO `commission` VALUES(189, 1.5, 4131, 21, 3771, 7464, 'photos', 1321972438, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(190, 0.75, 4131, 21, 3769, 7464, 'photos', 1321972660, NULL, 'subscription', 1);
INSERT INTO `commission` VALUES(191, -1, 4131, 0, 0, 0, 'refund', 1321974044, '', '', 1);
INSERT INTO `commission` VALUES(185, 0.75, 4131, 100, 249, 7465, 'photos', 1321957627, NULL, NULL, 1);
INSERT INTO `commission` VALUES(184, 0.75, 4131, 100, 250, 7466, 'photos', 1321957627, NULL, NULL, 1);
INSERT INTO `commission` VALUES(192, 0.75, 4131, 102, 254, 7465, 'photos', 1326904633, NULL, 'order', 1);
INSERT INTO `commission` VALUES(200, 93.75, 4131, 111, 263, 7471, 'photos', 1340960823, NULL, 'order', 1);
INSERT INTO `commission` VALUES(195, 0.75, 4131, 117, 269, 7471, 'photos', 1344945805, NULL, 'order', 1);
INSERT INTO `commission` VALUES(196, 0.75, 4131, 117, 270, 7465, 'photos', 1344945805, NULL, 'order', 1);
INSERT INTO `commission` VALUES(197, 0.75, 4131, 119, 272, 7464, 'photos', 1345648660, NULL, 'order', 1);
INSERT INTO `commission` VALUES(198, 1.88, 4131, 120, 273, 7471, 'photos', 1348159108, NULL, 'order', 1);
INSERT INTO `commission` VALUES(203, 0.75, 4131, 122, 276, 7470, 'photos', 1352801009, NULL, 'order', 1);
INSERT INTO `commission` VALUES(204, 0.75, 4131, 122, 275, 7471, 'photos', 1352801009, NULL, 'order', 1);
INSERT INTO `commission` VALUES(205, 0.75, 4131, 123, 277, 7471, 'photos', 1355489344, NULL, 'order', 1);
INSERT INTO `commission` VALUES(212, 0.75, 4131, 129, 284, 7471, 'photos', 1360580757, NULL, 'order', 1);
INSERT INTO `commission` VALUES(211, 0.75, 4131, 128, 283, 7471, 'photos', 1359828517, NULL, 'order', 1);
INSERT INTO `commission` VALUES(244, -1, 3931, 0, 0, 0, 'refund', 1362826307, 'webmoney', '', 1);
INSERT INTO `commission` VALUES(228, -1, 3931, 0, 0, 0, 'refund', 1362490646, 'dwolla', '', 1);
INSERT INTO `commission` VALUES(245, -1, 3931, 0, 0, 0, 'refund', 1362827344, 'paypal', '', 0);
INSERT INTO `commission` VALUES(246, -1, 3931, 0, 0, 0, 'refund', 1362827372, 'moneybookers', '', 0);
INSERT INTO `commission` VALUES(247, -1, 3931, 0, 0, 0, 'refund', 1362827398, 'qiwi', '', 0);
INSERT INTO `commission` VALUES(248, -1, 3931, 0, 0, 0, 'refund', 1362827423, 'dwolla', '', 0);
INSERT INTO `commission` VALUES(249, -1, 4131, 0, 0, 0, 'refund', 1362827675, 'paypal', '', 0);
INSERT INTO `commission` VALUES(252, 3, 4131, 130, 285, 7471, 'photos', 1362832950, NULL, 'order', 1);
INSERT INTO `commission` VALUES(309, 0.75, 4131, 146, 315, 7471, 'photos', 1372075943, NULL, 'order', 1);
INSERT INTO `commission` VALUES(308, 4.5, 4131, 142, 310, 8171, 'prints_items', 1366019007, NULL, 'order', 1);
INSERT INTO `commission` VALUES(301, 1.5, 4131, 134, 297, 8194, 'prints_items', 1365409882, NULL, 'order', 1);
INSERT INTO `commission` VALUES(300, 8.25, 4131, 134, 298, 9111, 'prints_items', 1365409882, NULL, 'order', 1);
INSERT INTO `commission` VALUES(299, 2.25, 4131, 134, 299, 7471, 'photos', 1365409882, NULL, 'order', 1);
INSERT INTO `commission` VALUES(307, 1.5, 4131, 142, 311, 8152, 'prints_items', 1366019007, NULL, 'order', 1);
INSERT INTO `commission` VALUES(310, 0.75, 4131, 147, 316, 7465, 'photos', 1376066670, NULL, 'order', 1);
INSERT INTO `commission` VALUES(315, -1, 3931, 0, 0, 0, 'refund', 1376824241, 'bank', '\nPrivatbank: 123456789', 0);
INSERT INTO `commission` VALUES(318, -1, 3931, 0, 0, 0, 'refund', 1376826095, 'other', '', 0);



CREATE TABLE `components` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `content` varchar(50) default NULL,
  `arows` int(11) default NULL,
  `acells` int(11) default NULL,
  `quantity` int(11) default NULL,
  `slideshow` int(11) default NULL,
  `slideshowtime` int(11) default NULL,
  `types` varchar(50) default NULL,
  `category` int(11) default NULL,
  `user` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `components` VALUES(4, 'Most popular small photos 1x5', 'photo1', 1, 5, 5, 0, 1, 'popular', 0, '');
INSERT INTO `components` VALUES(5, 'Featured big photos slideshow 1x1', 'photo2', 1, 1, 8, 1, 8, 'featured', 0, '');
INSERT INTO `components` VALUES(6, 'New small photos 20', 'photo2', 2, 10, 20, 0, 1, 'new', 0, '');
INSERT INTO `components` VALUES(7, 'Small random photos 4x3 slideshow', 'photo1', 3, 4, 20, 1, 2, 'random', 0, '');
INSERT INTO `components` VALUES(9, 'Most popular small photos 1x7', 'photo1', 1, 7, 7, 0, 1, 'popular', 0, '');
INSERT INTO `components` VALUES(10, 'New small photos 1x7', 'photo1', 1, 7, 7, 0, 1, 'new', 0, '');
INSERT INTO `components` VALUES(11, 'Random small photos 3x3', 'photo1', 3, 3, 9, 0, 1, 'random', 0, '');
INSERT INTO `components` VALUES(12, 'Featured photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'featured', 0, '');
INSERT INTO `components` VALUES(13, 'Most Downloaded photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'downloaded', 0, '');
INSERT INTO `components` VALUES(14, 'Most popular photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'popular', 0, '');
INSERT INTO `components` VALUES(15, 'Random photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'random', 0, '');
INSERT INTO `components` VALUES(16, 'Newest photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'new', 0, '');
INSERT INTO `components` VALUES(17, 'Free photos 7x2', 'photo1', 2, 7, 14, 0, 1, 'free', 0, '');
INSERT INTO `components` VALUES(18, 'Most Downloaded photos 10', 'photo2', 1, 10, 10, 0, 1, 'downloaded', 0, '');
INSERT INTO `components` VALUES(19, 'Featured photos 10', 'photo2', 1, 10, 10, 0, 1, 'featured', 0, '');
INSERT INTO `components` VALUES(20, 'Popular photos 10', 'photo2', 1, 10, 10, 0, 1, 'popular', 0, '');
INSERT INTO `components` VALUES(21, 'New photos 10', 'photo2', 1, 10, 10, 0, 1, 'new', 0, '');
INSERT INTO `components` VALUES(22, 'Free photos 10', 'photo2', 1, 10, 10, 0, 1, 'free', 0, '');
INSERT INTO `components` VALUES(23, 'Random photos 10', 'photo2', 1, 10, 10, 0, 1, 'random', 0, '');



CREATE TABLE `content_filter` (
  `words` text
);



INSERT INTO `content_filter` VALUES('bad,words');



CREATE TABLE `content_type` (
  `id_parent` int(11) NOT NULL auto_increment,
  `priority` int(11) default NULL,
  `name` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `name` (`name`),
  KEY `priority` (`priority`)
);



INSERT INTO `content_type` VALUES(4458, 1, 'Common');
INSERT INTO `content_type` VALUES(4459, 2, 'Premium');



CREATE TABLE `coupons` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `user` varchar(200) default NULL,
  `data2` int(11) default NULL,
  `total` float default NULL,
  `percentage` float default NULL,
  `url` varchar(200) default NULL,
  `used` int(11) default NULL,
  `orderid` int(11) default NULL,
  `data` int(11) default NULL,
  `ulimit` int(11) default NULL,
  `tlimit` int(11) default NULL,
  `coupon_id` int(11) default NULL,
  `coupon_code` varchar(250) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `coupon_id` (`coupon_id`),
  KEY `user` (`user`),
  KEY `data2` (`data2`),
  KEY `used` (`used`),
  KEY `tlimit` (`tlimit`),
  KEY `ulimit` (`ulimit`),
  KEY `data` (`data`),
  KEY `coupon_code` (`coupon_code`)
);



INSERT INTO `coupons` VALUES(7418, 'Order discount', 'buyer', 1321955454, 0, 10, '', 1, NULL, 1324547454, 1, 0, 4000, 'a5d5e7c06099a4fea2b9074673c407f3');
INSERT INTO `coupons` VALUES(7419, 'Order discount', 'buyer', 1340811039, 0, 10, '', 1, NULL, 1343403039, 1, 0, 4000, '16ad53afffe8ce425fc977760a67f49e');
INSERT INTO `coupons` VALUES(7420, 'Signup Bonus', 'guest7431', 1348338140, 0, 0, '', 1, NULL, 1350930140, 1, 0, 4001, '03f4e6eeb82f24c5f8791331f94de72f');
INSERT INTO `coupons` VALUES(7413, 'Promotion code', '', 1340344975, 0, 10, '', 1, NULL, 1340344975, 100, 0, 0, '613e8cf3dbab6104a010c670cc021aaf');
INSERT INTO `coupons` VALUES(7421, 'Signup Bonus', 'guest7432', 1348339434, 0, 0, '', 1, NULL, 1350931434, 1, 0, 4001, 'acd1fe04e0a0d533bfb19c06977385af');
INSERT INTO `coupons` VALUES(7422, 'Signup Bonus', 'guest7433', 1348340266, 0, 0, '', 1, NULL, 1350932266, 1, 0, 4001, 'fddf8534e44945f9ea7d171183660ce6');
INSERT INTO `coupons` VALUES(7423, 'Order discount', 'buyer', 1351347030, 0, 10, '', 1, NULL, 1353939030, 1, 0, 4000, 'cea6456e4ebcbf577b38631160f80b23');
INSERT INTO `coupons` VALUES(7425, 'Order discount', 'buyer', 1359537053, 0, 10, '', 1, NULL, 1362129053, 1, 0, 4000, '8c3a4c69bce3db8e8a95411f014ef08c');
INSERT INTO `coupons` VALUES(7426, 'Order discount', 'demo2', 1359828517, 0, 10, '', 1, NULL, 1362420517, 1, 0, 4000, 'bcbcbafe8dfd48c3a07c9f6b10ab6003');
INSERT INTO `coupons` VALUES(7427, 'Order discount', 'seller2', 1360580757, 0, 10, '', 1, NULL, 1363172757, 1, 0, 4000, 'afb8649cea5ec8cfb3e65c9a74f47cbe');
INSERT INTO `coupons` VALUES(7428, 'New coupon', '', 1360760863, 0.6, 0, '', 1, NULL, 1363352863, 1, 0, 0, '69d6225645ebf97c72ba43d27f26f43e');
INSERT INTO `coupons` VALUES(7429, 'Order discount', 'buyer', 1364900349, 0, 10, '', 1, NULL, 1367492349, 1, 0, 4000, '2126c8629095d33b27760d61b0d4812a');
INSERT INTO `coupons` VALUES(7430, 'Signup Bonus', 'tester', 1365617146, 0, 0, '', 1, NULL, 1368209146, 1, 0, 4001, 'dc5135acad41946f8fcc5d3eefd876c2');
INSERT INTO `coupons` VALUES(7431, 'New coupon', 'buyer', 1372066661, 0, 10, '', 1, NULL, 1374658661, 1, 0, 0, '4663f6b646e6a167250c2a15d7898676');
INSERT INTO `coupons` VALUES(7432, 'Order discount', 'buyer', 1372075944, 0, 10, '', 1, NULL, 1374667944, 1, 0, 4000, '15e7745fe60566c92282a70916197fd0');
INSERT INTO `coupons` VALUES(7433, 'Order discount', 'common', 1376066671, 0, 10, '', 0, NULL, 1378658671, 1, 0, 4000, '8def5e98fc3287f2c5df57c0534c1032');
INSERT INTO `coupons` VALUES(7434, 'Signup Bonus', 'guest7440', 1376838020, 0, 0, '', 0, NULL, 1379430020, 1, 0, 4001, '98c57a1e81a338e728b1a2b1945bd17c');
INSERT INTO `coupons` VALUES(7435, 'Signup Bonus', 'seller3', 1376838828, 0, 0, '', 0, NULL, 1379430828, 1, 0, 4001, '6990020877dbd915762376fa49f4aa5f');



CREATE TABLE `coupons_types` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `days` int(11) default NULL,
  `total` float default NULL,
  `percentage` float default NULL,
  `url` varchar(200) default NULL,
  `events` varchar(200) default NULL,
  `ulimit` int(11) default NULL,
  `bonus` float default NULL,
  KEY `id_parent` (`id_parent`)
);



INSERT INTO `coupons_types` VALUES(4000, 'Order discount', 30, 0, 10, '', 'New Order', 1, 0);
INSERT INTO `coupons_types` VALUES(4001, 'Signup Bonus', 30, 0, 0, '', 'New Signup', 1, 1);



CREATE TABLE `credits` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `quantity` int(11) default NULL,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `days` int(11) default NULL,
  KEY `id_parent` (`id_parent`)
);



INSERT INTO `credits` VALUES(4415, '1 Credits', 1, 1, 1, 0);
INSERT INTO `credits` VALUES(4416, '10 Credits', 10, 9, 2, 0);
INSERT INTO `credits` VALUES(4417, '20 Credits', 20, 17, 3, 0);
INSERT INTO `credits` VALUES(4418, '50 Credits', 50, 43, 4, 0);



CREATE TABLE `credits_list` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `quantity` float default NULL,
  `user` varchar(200) default NULL,
  `data` int(11) default NULL,
  `approved` int(11) default NULL,
  `payment` int(11) default NULL,
  `credits` int(11) default NULL,
  `expiration_date` int(11) default NULL,
  `subtotal` float default NULL,
  `discount` float default NULL,
  `taxes` float default NULL,
  `total` float default NULL,
  `billing_firstname` varchar(250) default NULL,
  `billing_lastname` varchar(250) default NULL,
  `billing_address` varchar(250) default NULL,
  `billing_city` varchar(250) default NULL,
  `billing_zip` varchar(250) default NULL,
  `billing_country` varchar(250) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`),
  KEY `user` (`user`),
  KEY `payment` (`payment`),
  KEY `approved` (`approved`),
  KEY `expiration_date` (`expiration_date`)
);



INSERT INTO `credits_list` VALUES(202, 'Credits bonus', 1000, 'buyer', 1365933219, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(27, '1 Credits', 1, 'buyer', 1312624220, 1, 0, 4415, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(28, '1 Credits', 1, 'buyer', 1312624786, 1, 0, 4415, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(47, 'Order _resh_88', -1, 'common', 1318183427, 1, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(46, '50 Credits', 50, 'common', 1318183400, 1, 0, 4418, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(48, 'Credits bonus', 20, 'buyer', 1318594133, 1, 0, 0, 1321186133, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(83, 'Signup Bonus', 1, 'qwert', 1328345657, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(80, 'Signup Bonus', 1, 'ewrwer', 1326281944, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(81, 'Signup Bonus', 1, 'ewrwer', 1326282744, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(82, 'Order _resh_102', -1, 'buyer', 1326904633, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(79, 'Signup Bonus', 1, 'ewrwer', 1326281871, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(78, 'Signup Bonus', 1, 'tester', 1322126542, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(77, 'Signup Bonus', 1, 'tester', 1322125812, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(76, 'Order _resh_101', -9, 'buyer', 1321958964, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(75, 'Order _resh_100', -2, 'buyer', 1321957627, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(73, 'Order _resh_98', -2, 'buyer', 1321955454, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(74, 'Order _resh_99', -2, 'buyer', 1321956317, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(132, '10 Credits', 10, 'buyer', 1347621192, 1, 0, 4416, 0, 9, 0, 0, 9, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(133, '10 Credits', 10, 'buyer', 1347621272, 0, 0, 4416, 0, 9, 0, 0, 9, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(131, '10 Credits', 10, 'buyer', 1347620505, 1, 0, 4416, 0, 9, 0, 0, 9, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(125, 'Order _resh_111', -125, 'buyer', 1340960823, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(126, 'Signup Bonus', 1, 'tester', 1341215968, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(128, 'Order _resh_117', -2, 'buyer', 1344945806, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(129, '1 Credits', 1, 'buyer', 1347618342, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(130, '1 Credits', 1, 'buyer', 1347618410, 0, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(99, '25 Credits', 25, 'buyer', 1337343807, 1, 7388, 0, 0, 50, 0, 0, 50, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(134, 'Order _resh_120', -2.5, 'buyer', 1348159109, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(135, 'Signup Bonus', 1, 'demo3', 1348481040, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(136, '1 Credits', 1, 'buyer', 1348913224, 1, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(137, '1 Credits', 1, 'buyer', 1348913273, 1, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(138, 'Order _resh_122', -2, 'buyer', 1352801010, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(139, '1 Credits', 1, 'buyer', 1354298698, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(140, '1 Credits', 1, 'buyer', 1354380364, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(141, '1 Credits', 1, 'buyer', 1354383103, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(142, '1 Credits', 1, 'buyer', 1354383148, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(143, '1 Credits', 1, 'buyer', 1354383194, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(144, '1 Credits', 1, 'buyer', 1355486497, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(145, '1 Credits', 1, 'buyer', 1355486672, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(146, '1 Credits', 1, 'buyer', 1355486924, 0, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(147, '1 Credits', 1, 'buyer', 1355486968, 0, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(148, '1 Credits', 1, 'buyer', 1355487086, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(149, '1 Credits', 1, 'buyer', 1355487154, 0, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(150, '1 Credits', 1, 'buyer', 1355487211, 1, 2147483647, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(151, '1 Credits', 1, 'buyer', 1355489827, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(152, '1 Credits', 1, 'buyer', 1355742632, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(153, '1 Credits', 1, 'buyer', 1355742665, 0, 0, 4415, 0, 1, 0, 0, 1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(154, '1 Credits', 1, 'buyer', 1355743979, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(155, '1 Credits', 1, 'buyer', 1356120744, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(156, '1 Credits', 1, 'buyer', 1356121006, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(158, 'Order _resh_124', -3, 'buyer', 1359537053, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(159, 'Order _resh_125', -4, 'buyer', 1359547266, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(160, 'Order _resh_126', -7, 'buyer', 1359558982, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(161, 'Order _resh_127', -2, 'buyer', 1359635544, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(165, '1 Credits', 1, 'demo2', 1359829315, 1, 0, 4415, 0, 1, 0, 0, 1, 'Jeff', 'Ri_char_ds', '1st Rd.', 'New York', '12345', '');
INSERT INTO `credits_list` VALUES(163, 'Credits bonus', 5, 'demo2', 1359828140, 1, 0, 0, 1359828519, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(164, 'Order _resh_128', -1, 'demo2', 1359828517, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(166, 'Signup Bonus', 1, 'seller2', 1360235342, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(167, 'Order _resh_129', -1, 'seller2', 1360580757, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(185, '1 Credits', 1, 'buyer', 1362832875, 1, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(186, 'Order _resh_130', -4, 'buyer', 1362832950, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(187, '1 Credits', 1, 'buyer', 1363084579, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(182, '1 Credits', 1, 'buyer', 1362503485, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(183, '1 Credits', 1, 'buyer', 1362504310, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(184, '1 Credits', 1, 'common', 1362825263, 0, 0, 4415, 0, 1, 0, 0, 1, 'Bob', 'Smith', '', 'Wien', '', 'Austria');
INSERT INTO `credits_list` VALUES(188, '1 Credits', 1, 'buyer', 1363084874, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(189, '1 Credits', 1, 'buyer', 1363085086, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(190, '1 Credits', 1, 'buyer', 1363085835, 0, 0, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(192, 'Order _resh_132', -51, 'buyer', 1364900732, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(193, 'Order _resh_133', -1, 'buyer', 1365409686, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(194, 'Order _resh_134', -18, 'buyer', 1365409882, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(199, '1 Credits', 1, 'buyer', 1365838266, 1, 7398, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(198, '1 Credits', 1, 'buyer', 1365838159, 1, 7397, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(197, '1 Credits', 1, 'buyer', 1365836623, 1, 7396, 4415, 0, 1, 0, 0, 1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(203, 'Order _resh_138', -1, 'buyer', 1365933559, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(204, 'Order _resh_139', -6, 'buyer', 1365934052, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(205, 'Order _resh_140', -1, 'buyer', 1365934185, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(206, 'Order _resh_142', -9, 'buyer', 1366019008, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(210, '1 Credits', 1, 'buyer', 1368729317, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(209, '1 Credits', 1, 'buyer', 1367662492, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(211, '1 Credits', 1, 'buyer', 1369382571, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(212, '1 Credits', 1, 'buyer', 1369386453, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(213, '1 Credits', 1, 'buyer', 1370621690, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(214, '1 Credits', 1, 'buyer', 1370621953, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(215, '1 Credits', 1, 'buyer', 1370621992, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(216, '1 Credits', 1, 'buyer', 1370622150, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(217, '1 Credits', 1, 'buyer', 1370622326, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(218, '1 Credits', 1, 'buyer', 1370623018, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(219, '1 Credits', 1, 'buyer', 1370860325, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(220, '1 Credits', 1, 'buyer', 1370860440, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(221, '1 Credits', 1, 'buyer', 1370861083, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(222, '1 Credits', 1, 'common', 1371797590, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'Bob', 'Smith', '', 'Wien', '', 'Austria');
INSERT INTO `credits_list` VALUES(223, '1 Credits', 1, 'common', 1371797649, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, '', '', '', '', '', '');
INSERT INTO `credits_list` VALUES(224, '1 Credits', 1, 'common', 1371797818, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'Bob', 'Smith', '', 'Wien', '', 'Austria');
INSERT INTO `credits_list` VALUES(225, '1 Credits', 1, 'common', 1371797858, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'Bob', 'Smith', '', 'Wien', '', 'Austria');
INSERT INTO `credits_list` VALUES(226, '1 Credits', 1, 'common', 1371920235, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'Bob', 'Smith', '', 'Wien', '', 'Austria');
INSERT INTO `credits_list` VALUES(227, 'Order _resh_146', -1, 'buyer', 1372075944, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(228, 'Order _resh_147', -1, 'common', 1376066670, 1, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `credits_list` VALUES(229, '1 Credits', 1, 'buyer', 1376841347, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `credits_list` VALUES(230, '1 Credits', 1, 'buyer', 1376841633, 0, 0, 4415, 0, 1, 0, 0.1, 1.1, 'John', 'Brown', '', 'Los Angeles', '', 'United States');



CREATE TABLE `currency` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `code1` varchar(10) default NULL,
  `code2` varchar(10) default NULL,
  `activ` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `currency` VALUES(1, 'Australian Dollars', 'AUD', 'A $', 0);
INSERT INTO `currency` VALUES(2, 'Canadian Dollars', 'CAD', 'C $', 0);
INSERT INTO `currency` VALUES(3, 'Euros', 'EUR', '&euro;', 0);
INSERT INTO `currency` VALUES(4, 'Pounds Sterling', 'GBP', '&pound;', 0);
INSERT INTO `currency` VALUES(5, 'Yen', 'JPY', '&yen;', 0);
INSERT INTO `currency` VALUES(6, 'U.S. Dollars', 'USD', '$', 1);
INSERT INTO `currency` VALUES(7, 'New Zealand Dollar', 'NZD', '$', 0);
INSERT INTO `currency` VALUES(8, 'Swiss Franc', 'CHF', NULL, 0);
INSERT INTO `currency` VALUES(9, 'Hong Kong Dollar', 'HKD', '$', 0);
INSERT INTO `currency` VALUES(10, 'Singapore Dollar', 'SGD', '$', 0);
INSERT INTO `currency` VALUES(11, 'Swedish Krona', 'SEK', NULL, 0);
INSERT INTO `currency` VALUES(12, 'Danish Krone', 'DKK', NULL, 0);
INSERT INTO `currency` VALUES(13, 'Polish Zloty', 'PLN', NULL, 0);
INSERT INTO `currency` VALUES(14, 'Norwegian Krone', 'NOK', NULL, 0);
INSERT INTO `currency` VALUES(15, 'Hungarian Forint', 'HUF', NULL, 0);
INSERT INTO `currency` VALUES(16, 'Czech Koruna', 'CZK', NULL, 0);
INSERT INTO `currency` VALUES(17, 'UAE Dirham', 'AED', NULL, 0);
INSERT INTO `currency` VALUES(18, 'Jordanian dinar', 'JOD', NULL, 0);
INSERT INTO `currency` VALUES(19, 'Egyptian Pound', 'EGP', NULL, 0);
INSERT INTO `currency` VALUES(20, 'Saudi Riyal', 'SAR', NULL, 0);
INSERT INTO `currency` VALUES(21, 'Russian Ruble', 'RUB', NULL, 0);
INSERT INTO `currency` VALUES(22, 'Ukraine Hryvnia', 'UAH', NULL, 0);
INSERT INTO `currency` VALUES(23, 'Belarus Ruble', 'BYR', NULL, 0);
INSERT INTO `currency` VALUES(24, 'Uzbekistan Sum', 'UZS', NULL, 0);
INSERT INTO `currency` VALUES(25, 'Thai Baht', 'THB', NULL, 0);
INSERT INTO `currency` VALUES(26, 'Israeli Shekel', 'ILS', NULL, 0);
INSERT INTO `currency` VALUES(27, 'Mexican Peso', 'MXN', NULL, 0);
INSERT INTO `currency` VALUES(28, 'Lithuanian Litas', 'LT', NULL, 0);
INSERT INTO `currency` VALUES(29, 'Indian rupee', 'INR', NULL, 0);
INSERT INTO `currency` VALUES(30, 'Bulgarian Lev', 'BGN', NULL, 0);
INSERT INTO `currency` VALUES(32, 'Rial', 'IRR', NULL, 0);
INSERT INTO `currency` VALUES(33, 'Leu', 'RON', NULL, 0);
INSERT INTO `currency` VALUES(34, 'Manat', 'AZN', NULL, 0);
INSERT INTO `currency` VALUES(35, 'Brazilian Real', 'BRL', NULL, 0);
INSERT INTO `currency` VALUES(36, 'Korean Won', 'KRW', '&#8361;', 0);
INSERT INTO `currency` VALUES(38, 'Kazakhstan Tenge', 'KZT', '', 0);



CREATE TABLE `downloads` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `link` varchar(250) default NULL,
  `data` int(11) default NULL,
  `tlimit` int(11) default NULL,
  `ulimit` int(11) default NULL,
  `order_id` int(11) default NULL,
  `user_id` int(11) default NULL,
  `subscription_id` int(11) default NULL,
  `publication_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `link` (`link`),
  KEY `data` (`data`),
  KEY `tlimit` (`tlimit`),
  KEY `ulimit` (`ulimit`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `subscription_id` (`subscription_id`),
  KEY `publication_id` (`publication_id`)
);



INSERT INTO `downloads` VALUES(97, 3787, 'd8c7ea71d07437f30a309ba8c53b2b3f', 1323253627, 2, 5, 100, 6355, 0, 7466);
INSERT INTO `downloads` VALUES(96, 3778, 'c573e8fc3049eedda366de176124494a', 1323253627, 2, 5, 100, 6355, 0, 7465);
INSERT INTO `downloads` VALUES(98, 1094, '5eaec0488594b3427d894af96ec74f64', 1323254964, 0, 5, 101, 6355, 0, 5041);
INSERT INTO `downloads` VALUES(99, 1098, '1d2facc7eb8f3823fd5862468cfe7ad2', 1323254964, 1, 5, 101, 6355, 0, 4817);
INSERT INTO `downloads` VALUES(100, 957, '0e9a0598257ceaf36138667e6a845626', 1323254964, 0, 5, 101, 6355, 0, 4839);
INSERT INTO `downloads` VALUES(101, 3771, '9305cb8a4e178fa184cc3b64d4546a01', 1323268438, 6, 5, 0, 6355, 21, 7464);
INSERT INTO `downloads` VALUES(102, 3769, '5bb681eabac251924c4400345744c878', 1323268660, 1, 5, 0, 6355, 21, 7464);
INSERT INTO `downloads` VALUES(103, 3778, '5cd80c0c3373359dc0ecda1615974d5b', 1328200633, 0, 5, 102, 6355, 0, 7465);
INSERT INTO `downloads` VALUES(105, 3833, '7d7ab87599e68460f209a30ccd02d03a', 1342256823, 0, 5, 111, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(106, 3832, '508eae473c149a25234ed7363d0c49f0', 1346241805, 0, 5, 117, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(107, 3778, '461dcdabea8e11cc6c8f99f8d2bf2b4f', 1346241806, 0, 5, 117, 6355, 0, 7465);
INSERT INTO `downloads` VALUES(108, 3769, '85e5ad3a903d6f3055902f38858ca864', 1346944847, 0, 5, 119, 6355, 0, 7464);
INSERT INTO `downloads` VALUES(109, 3834, 'e9cecbfff1982543ef79a9e6b5fecc41', 1350977415, 0, 5, 120, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(110, 3796, '7015524c2298f28b45124f15d265d402', 1352360086, 0, 5, 105, 6355, 0, 7467);
INSERT INTO `downloads` VALUES(111, 3746, '848c68e80081744ee9847d9bc3b4f464', 1352729720, 0, 5, 118, 6355, 0, 7461);
INSERT INTO `downloads` VALUES(112, 3832, '0da81f2d2fc8ac091e7b03b47d65294a', 1354097010, 2, 5, 122, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(113, 3823, 'e4760f8b85cfde5b27a36f1e9de5dcc5', 1354097010, 0, 5, 122, 6355, 0, 7470);
INSERT INTO `downloads` VALUES(114, 3832, 'de3360af4975a57718ce315b227385d7', 1356785371, 0, 5, 123, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(121, 3832, '809177f7f478f972b84cbaf2321b270c', 1361876757, 0, 5, 129, 7435, 0, 7471);
INSERT INTO `downloads` VALUES(120, 3832, '6250a4c207e5971b899d54c57a2f5a00', 1361124517, 0, 5, 128, 4113, 0, 7471);
INSERT INTO `downloads` VALUES(122, 3838, '92acd9dd95c3f575f97a428405157f3f', 1364128950, 0, 5, 130, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(126, 3836, '9e414cb1fd4486ab62b6dfd4496ef0bb', 1366705882, 0, 5, 134, 6355, 0, 7471);
INSERT INTO `downloads` VALUES(132, 3778, '64cea583b6fdde987ee7cc53096da3de', 1377362670, 0, 5, 147, 7403, 0, 7465);
INSERT INTO `downloads` VALUES(131, 3832, 'fed57945ea7f39d18242cd2ee34e661a', 1373371943, 0, 5, 146, 6355, 0, 7471);



CREATE TABLE `examinations` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) default NULL,
  `data` int(11) default NULL,
  `status` int(11) default NULL,
  `comments` text,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`data`),
  KEY `user` (`user`),
  KEY `data` (`data`)
);



INSERT INTO `examinations` VALUES(2, 3931, 1241736827, 1, 'You are welcome!');
INSERT INTO `examinations` VALUES(8, 7403, 1345188276, 1, '');
INSERT INTO `examinations` VALUES(7, 6360, 1297165561, 1, '');
INSERT INTO `examinations` VALUES(9, 7435, 1360519118, 1, '');



CREATE TABLE `ffmpeg` (
  `fpath` varchar(250) default NULL,
  `video_width` int(11) default NULL,
  `video_height` int(11) default NULL,
  `thumb_width` int(11) default NULL,
  `thumb_height` int(11) default NULL,
  `ffmpeg` int(11) default NULL,
  `frequency` int(11) default NULL,
  `duration` int(11) default NULL,
  `video_format` varchar(10) default NULL
);



INSERT INTO `ffmpeg` VALUES('/usr/local/bin/ffmpeg', 400, 280, 120, 80, 0, 5, 10, 'mp4');



CREATE TABLE `filestorage` (
  `id` int(11) NOT NULL auto_increment,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `types` int(11) default NULL,
  `name` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  KEY `activ` (`activ`),
  KEY `types` (`types`)
);



INSERT INTO `filestorage` VALUES(1, '/content', 0, 0, 'Local server');
INSERT INTO `filestorage` VALUES(2, '/content2', 1, 0, 'Local server');
INSERT INTO `filestorage` VALUES(4, NULL, 0, 1, 'Rackspace cloud');
INSERT INTO `filestorage` VALUES(5, NULL, 0, 2, 'Amazon S3');



CREATE TABLE `filestorage_amazon` (
  `prefix` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `username` varchar(100) default NULL,
  `api_key` varchar(250) default NULL,
  `region` varchar(100) default NULL
);



INSERT INTO `filestorage_amazon` VALUES('cmsaccount', 0, 'cmsaccount', 'test', 'REGION_US_E1');



CREATE TABLE `filestorage_files` (
  `id_parent` int(11) default NULL,
  `item_id` int(11) default NULL,
  `url` varchar(250) default NULL,
  `filename1` varchar(100) default NULL,
  `filename2` varchar(100) default NULL,
  `filesize` int(11) default NULL,
  `server1` int(11) default NULL,
  `pdelete` int(11) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL
);



CREATE TABLE `filestorage_logs` (
  `publication_id` int(11) default NULL,
  `logs` text,
  `data` int(11) default NULL
);



CREATE TABLE `filestorage_rackspace` (
  `prefix` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `username` varchar(100) default NULL,
  `api_key` varchar(250) default NULL,
  `cron` int(11) default NULL
);



INSERT INTO `filestorage_rackspace` VALUES('cmsaccount1', 0, 'cmsaccount', 'test', 1);



CREATE TABLE `friends` (
  `id_parent` int(11) default NULL,
  `friend1` varchar(200) default NULL,
  `friend2` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `friend1` (`friend1`),
  KEY `friend2` (`friend2`)
);



INSERT INTO `friends` VALUES(NULL, 'demo', 'john');
INSERT INTO `friends` VALUES(NULL, 'demo', 'siteowner');
INSERT INTO `friends` VALUES(NULL, 'siteowner', 'demo');
INSERT INTO `friends` VALUES(NULL, 'john', 'demo');
INSERT INTO `friends` VALUES(NULL, 'buyer', 'siteowner');
INSERT INTO `friends` VALUES(NULL, 'buyer', 'john');



CREATE TABLE `gateway_2checkout` (
  `account` varchar(250) default NULL,
  `word` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_2checkout` VALUES('1111112', 'good', 'https://www2.2checkout.com/2co/buyer/purchase', 0, 1);



CREATE TABLE `gateway_alertpay` (
  `account` varchar(200) default NULL,
  `ipn` int(11) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `security_code` varchar(250) default NULL
);



INSERT INTO `gateway_alertpay` VALUES('sales@cmsaccount.com', 1, 'https://www.alertpay.com/checkout', 0, 'YnEmI8amtCXPw8Tq');


CREATE TABLE `gateway_authorize` (
  `account` varchar(250) default NULL,
  `txnkey` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_authorize` VALUES('cmsaccount', 'HjIiT4wOFskhYnwh', 'https://secure.authorize.net/gateway/transact.dll', 0, 1);



CREATE TABLE `gateway_cashu` (
  `account` varchar(250) default NULL,
  `ecode` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_cashu` VALUES('test@cashucard.com', '234b23b42kj423', 'https://www.cashu.com/cgi-bin/pcashu.cgi', 0, 1);



CREATE TABLE `gateway_cashx` (
  `account` varchar(200) default NULL,
  `ipn` int(11) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `security_code` varchar(250) default NULL
);



INSERT INTO `gateway_cashx` VALUES('sales@cmsaccount.com', 1, 'https://www.cashx.com/checkout', 0, '1I1rdlDNL9dHkUPWHhW8y4tq');



CREATE TABLE `gateway_ccbill` (
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `product_id` varchar(50) default NULL,
  `subscription` int(11) default NULL,
  `credits` int(11) default NULL,
  `account` varchar(50) default NULL,
  `account2` varchar(50) default NULL,
  `account3` varchar(50) default NULL
);



INSERT INTO `gateway_ccbill` VALUES('https://bill.ccbill.com/jpost/signup.cgi', 0, 1, NULL, 0, 0, 'account', 'subaccount', 'formID');
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008001', 4461, 0, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008002', 4462, 0, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008003', 4464, 0, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008004', 4465, 0, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008005', 0, 4415, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008006', 0, 4416, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008007', 0, 4417, '', NULL, NULL);
INSERT INTO `gateway_ccbill` VALUES('', 0, 0, '0000008008', 0, 4418, '', NULL, NULL);



CREATE TABLE `gateway_chronopay` (
  `account` varchar(250) default NULL,
  `ekey` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_chronopay` VALUES('cmsaccount', 'world', 'https://payments.chronopay.com/', 0, 1);



CREATE TABLE `gateway_clickbank` (
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `product_id` varchar(50) default NULL,
  `subscription` int(11) default NULL,
  `credits` int(11) default NULL,
  `account` varchar(50) default NULL,
  `account2` varchar(50) default NULL
);



INSERT INTO `gateway_clickbank` VALUES('http://www.clickbank.net/sell.cgi', 0, 1, NULL, 0, 0, 'videosourc', 'TESTTESTTESTTEST');
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 4461, 0, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 4462, 0, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 4464, 0, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 4465, 0, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 0, 4415, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 0, 4416, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 0, 4417, '', NULL);
INSERT INTO `gateway_clickbank` VALUES('', 0, 0, '1', 0, 4418, '', NULL);



CREATE TABLE `gateway_dotpay` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_dotpay` VALUES('test', 'test', 0);



CREATE TABLE `gateway_dwolla` (
  `account` varchar(200) default NULL,
  `pin` varchar(4) default NULL,
  `apikey` varchar(200) default NULL,
  `apisecret` varchar(200) default NULL,
  `test` tinyint(4) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_dwolla` VALUES('210-268-9238', '1111', 'test', 'test', 0, 0);



CREATE TABLE `gateway_egold` (
  `account` varchar(250) default NULL,
  `name` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_egold` VALUES('123', 'cmsaccount', '', 'https://www.e-gold.com/sci_asp/payments.asp', 0, 1);



CREATE TABLE `gateway_enets` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_enets` VALUES('cmsaccount', 'https://www.enetspayments.com.sg/masterMerchant/collectionPage.jsp', 0, 1);



CREATE TABLE `gateway_epassporte` (
  `account` varchar(250) default NULL,
  `pcode` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_epassporte` VALUES('rt_5222', '1234', 'https://www.epassporte.com/secure/eppurchase.cgi', 0, 1);



CREATE TABLE `gateway_epay` (
  `account` varchar(200) default NULL,
  `ipn` int(11) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `security_code` varchar(250) default NULL
);



INSERT INTO `gateway_epay` VALUES('D229773874', 1, 'https://www.epay.bg', 0, 'RJAVAMNGCDWG5PQAK5MNLFJD15MJCJCTH1WGIMUTWT46N2WR7BM0B6U6WK58VF5P');



CREATE TABLE `gateway_epaykkbkz` (
  `account` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_epaykkbkz` VALUES('1', 0);



CREATE TABLE `gateway_epoch` (
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `product_id` varchar(50) default NULL,
  `subscription` int(11) default NULL,
  `credits` int(11) default NULL,
  `account` varchar(50) default NULL
);



INSERT INTO `gateway_epoch` VALUES('https://wnu.com/secure/fpost.cgi', 0, 1, '0', 0, 0, '123451');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '1', 4461, 0, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 4462, 0, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 4464, 0, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 4465, 0, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 0, 4415, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 0, 4416, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 0, 4417, '');
INSERT INTO `gateway_epoch` VALUES('', 0, 0, '0', 0, 4418, '');



CREATE TABLE `gateway_eway` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_eway` VALUES('cmsaccount', 'https://www.eway.com.au/gateway/payment.asp', 0, 1);



CREATE TABLE `gateway_fortumo` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_fortumo` VALUES('6c501a2a9a6c3f64ebe9431800ed95a7', '618906475986414b69aea96768edb318', 1);



CREATE TABLE `gateway_google` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `mkey` varchar(200) default NULL
);



INSERT INTO `gateway_google` VALUES('539866586074106', 'https://sandbox.google.com/checkout/api/checkout/v2/checkoutForm/Merchant/{merchant_id}', 0, 1, 'MIZmNZU08S0_PZYsh7x6ZQ');



CREATE TABLE `gateway_linkpoint` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_linkpoint` VALUES('123455', 'https://www.linkpointcentral.com/lpc/servlet/lppay', 0, 1);



CREATE TABLE `gateway_moneybookers` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `password` varchar(250) default NULL
);



INSERT INTO `gateway_moneybookers` VALUES('sales@cmsaccount.com', 'https://www.moneybookers.com/app/payment.pl', 0, 1, 'test');



CREATE TABLE `gateway_moneyua` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` tinyint(4) default NULL,
  `testmode` tinyint(4) default NULL,
  `commission` tinyint(4) default NULL
);



INSERT INTO `gateway_moneyua` VALUES('test', 'test', 0, 1, 0);



CREATE TABLE `gateway_multicards` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `account2` varchar(100) default NULL,
  `password` varchar(100) default NULL
);



INSERT INTO `gateway_multicards` VALUES('123456', 'https://secure.multicards.com/cgi-bin/order2/processorder1.pl', 0, 1, '1', 'test');



CREATE TABLE `gateway_myvirtualmerchant` (
  `account` varchar(250) default NULL,
  `account2` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_myvirtualmerchant` VALUES('test1', 'test2', 'test3', '', 0, 1);



CREATE TABLE `gateway_nochex` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_nochex` VALUES('cmsaccount', 'https://secure.nochex.com/', 0, 1);



CREATE TABLE `gateway_pagseguro` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_pagseguro` VALUES('ricardo.limarh@gmail.com', 'test2', 0);



CREATE TABLE `gateway_paxum` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_paxum` VALUES('test@mail.com', 'test2', 0);



CREATE TABLE `gateway_paypal` (
  `account` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_paypal` VALUES('sales@cmsaccount.com', 'https://www.paypal.com/cgi-bin/webscr', 1, 1);



CREATE TABLE `gateway_paypalpro` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `signature` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_paypalpro` VALUES('sales@cmsaccount.com', '123456', 'test', 1, 1);



CREATE TABLE `gateway_payprin` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_payprin` VALUES('cmsaccount', '1234', 0);



CREATE TABLE `gateway_paysera` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_paysera` VALUES('test', 'test', 0);



CREATE TABLE `gateway_payu` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `password2` varchar(250) default NULL,
  `password3` varchar(250) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_payu` VALUES('test', 'test', 'test', 'test', 0);



CREATE TABLE `gateway_privatbank` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` tinyint(4) default NULL
);



INSERT INTO `gateway_privatbank` VALUES('test', 'test', 0);



CREATE TABLE `gateway_qiwi` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_qiwi` VALUES('10859', 'test', '', 1, 1);



CREATE TABLE `gateway_rbkmoney` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_rbkmoney` VALUES('cmsaccount', 'test1', 0);



CREATE TABLE `gateway_robokassa` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `password2` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_robokassa` VALUES('cmsaccount', 'test1234', 'test4321', 0);



CREATE TABLE `gateway_secpay` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `subject` varchar(250) default NULL,
  `message` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_secpay` VALUES('cmsaccount', '1', 'subject', 'message', 'https://www.secpay.com/java-bin/ValCard', 0, 1);



CREATE TABLE `gateway_segpay` (
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL,
  `package_id` varchar(50) default NULL,
  `product_id` varchar(50) default NULL,
  `subscription` int(11) default NULL,
  `credits` int(11) default NULL
);



INSERT INTO `gateway_segpay` VALUES('https://secure2.segpay.com/billing/poset.cgi', 0, 1, '0', '0', 0, 0);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '1111', '4', 4465, 0);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '1111', '3', 4464, 0);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '1111', '2', 4462, 0);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '1111', '1', 4461, 0);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '2222', '5', 0, 4415);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '2222', '6', 0, 4416);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '2222', '7', 0, 4417);
INSERT INTO `gateway_segpay` VALUES('', 0, 0, '2222', '8', 0, 4418);



CREATE TABLE `gateway_stripe` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_stripe` VALUES('pk_test_pa0tWISqU9pjRw6vggQhPGpY', 'sk_test_bG32VhNfdOWM5NvLMgG5G67X', 0);



CREATE TABLE `gateway_webmoney` (
  `account` varchar(250) default NULL,
  `ecode` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_webmoney` VALUES('Z160139856701', 'grgtrgrtgrt', 'https://merchant.webmoney.ru/lmi/payment.asp', 0, 1);



CREATE TABLE `gateway_worldpay` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `ipn` int(11) default NULL
);



INSERT INTO `gateway_worldpay` VALUES('123', '1', 'https://select.worldpay.com/wcc/purchase', 0, 1);



CREATE TABLE `gateway_zombaio` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `price` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `gateway_zombaio` VALUES('287654948', '84WS4308V3X4R6T7223N', '1479069', 0);



CREATE TABLE `items` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `name` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `shipped` tinyint(1) default NULL,
  `price_id` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`),
  KEY `price_id` (`price_id`)
);



INSERT INTO `items` VALUES(957, 4839, 'ZIP', 'vector.zip', 5, 0, 0, 4804);
INSERT INTO `items` VALUES(4944, 7658, 'MP3', 'audio2.mp3', 10, 1, 0, 6783);
INSERT INTO `items` VALUES(3838, 7471, 'Original size', '_IMG_6638.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(4941, 7657, 'Shipped CD', '', 100, 3, 1, 6784);
INSERT INTO `items` VALUES(4945, 7658, 'Shipped CD', '', 100, 3, 1, 6784);
INSERT INTO `items` VALUES(4940, 7657, 'MP3', 'audio1.mp3', 10, 1, 0, 6783);
INSERT INTO `items` VALUES(2662, 7176, 'ZIP', 'cd.zip', 5, 2, 0, 4804);
INSERT INTO `items` VALUES(3839, 7471, 'Extended Legal Guarantee covers up to $250,000', '_IMG_6638.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3815, 7469, 'Unlimited Reproduction / Print Runs', '_IMG_4648.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3816, 7469, 'Medium', '_IMG_4648.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3817, 7469, 'Items for Resale (limited run)', '_IMG_4648.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3818, 7469, 'Large', '_IMG_4648.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3819, 7469, 'Electronic Items for Resale (unlimited run)', '_IMG_4648.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3820, 7469, 'Original size', '_IMG_4648.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3821, 7469, 'Extended Legal Guarantee covers up to $250,000', '_IMG_4648.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3822, 7470, 'Multi-Seat (unlimited)', '_IMG_5257.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3823, 7470, 'Small', '_IMG_5257.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3824, 7470, 'Unlimited Reproduction / Print Runs', '_IMG_5257.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3825, 7470, 'Medium', '_IMG_5257.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3826, 7470, 'Items for Resale (limited run)', '_IMG_5257.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3827, 7470, 'Large', '_IMG_5257.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3828, 7470, 'Electronic Items for Resale (unlimited run)', '_IMG_5257.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3829, 7470, 'Original size', '_IMG_5257.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3830, 7470, 'Extended Legal Guarantee covers up to $250,000', '_IMG_5257.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3831, 7471, 'Multi-Seat (unlimited)', '_IMG_6638.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3832, 7471, 'Small', '_IMG_6638.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3833, 7471, 'Unlimited Reproduction / Print Runs', '_IMG_6638.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3834, 7471, 'Medium', '_IMG_6638.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3835, 7471, 'Items for Resale (limited run)', '_IMG_6638.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3836, 7471, 'Large', '_IMG_6638.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3837, 7471, 'Electronic Items for Resale (unlimited run)', '_IMG_6638.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3790, 7466, 'Items for Resale (limited run)', '_IMG_3289.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3791, 7466, 'Large', '_IMG_3289.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3792, 7466, 'Electronic Items for Resale (unlimited run)', '_IMG_3289.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3793, 7466, 'Original size', '_IMG_3289.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3794, 7466, 'Extended Legal Guarantee covers up to $250,000', '_IMG_3289.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3795, 7467, 'Multi-Seat (unlimited)', '_IMG_3329.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3796, 7467, 'Small', '_IMG_3329.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3797, 7467, 'Unlimited Reproduction / Print Runs', '_IMG_3329.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3798, 7467, 'Medium', '_IMG_3329.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3799, 7467, 'Items for Resale (limited run)', '_IMG_3329.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3800, 7467, 'Large', '_IMG_3329.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3801, 7467, 'Electronic Items for Resale (unlimited run)', '_IMG_3329.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3802, 7467, 'Original size', '_IMG_3329.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3803, 7467, 'Extended Legal Guarantee covers up to $250,000', '_IMG_3329.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3804, 7468, 'Multi-Seat (unlimited)', '_IMG_4143.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3805, 7468, 'Small', '_IMG_4143.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3806, 7468, 'Unlimited Reproduction / Print Runs', '_IMG_4143.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3807, 7468, 'Medium', '_IMG_4143.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3808, 7468, 'Items for Resale (limited run)', '_IMG_4143.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3809, 7468, 'Large', '_IMG_4143.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3810, 7468, 'Electronic Items for Resale (unlimited run)', '_IMG_4143.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3811, 7468, 'Original size', '_IMG_4143.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3812, 7468, 'Extended Legal Guarantee covers up to $250,000', '_IMG_4143.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3813, 7469, 'Multi-Seat (unlimited)', '_IMG_4648.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3814, 7469, 'Small', '_IMG_4648.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3750, 7462, 'Multi-Seat (unlimited)', '_IMG_3319.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3751, 7462, 'Small', '_IMG_3319.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3752, 7462, 'Unlimited Reproduction / Print Runs', '_IMG_3319.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3753, 7462, 'Medium', '_IMG_3319.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3754, 7462, 'Items for Resale (limited run)', '_IMG_3319.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3755, 7462, 'Large', '_IMG_3319.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3756, 7462, 'Electronic Items for Resale (unlimited run)', '_IMG_3319.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3757, 7462, 'Original size', '_IMG_3319.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3758, 7462, 'Extended Legal Guarantee covers up to $250,000', '_IMG_3319.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3759, 7463, 'Multi-Seat (unlimited)', '_IMG_3733.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3760, 7463, 'Small', '_IMG_3733.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3761, 7463, 'Unlimited Reproduction / Print Runs', '_IMG_3733.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3762, 7463, 'Medium', '_IMG_3733.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3763, 7463, 'Items for Resale (limited run)', '_IMG_3733.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3764, 7463, 'Large', '_IMG_3733.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3765, 7463, 'Electronic Items for Resale (unlimited run)', '_IMG_3733.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3766, 7463, 'Original size', '_IMG_3733.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3767, 7463, 'Extended Legal Guarantee covers up to $250,000', '_IMG_3733.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3768, 7464, 'Multi-Seat (unlimited)', '_IMG_4055.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3769, 7464, 'Small', '_IMG_4055.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3770, 7464, 'Unlimited Reproduction / Print Runs', '_IMG_4055.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3771, 7464, 'Medium', '_IMG_4055.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3772, 7464, 'Items for Resale (limited run)', '_IMG_4055.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3773, 7464, 'Large', '_IMG_4055.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3774, 7464, 'Electronic Items for Resale (unlimited run)', '_IMG_4055.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3775, 7464, 'Original size', '_IMG_4055.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3776, 7464, 'Extended Legal Guarantee covers up to $250,000', '_IMG_4055.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3740, 7459, 'Extended Legal Guarantee covers up to $250,000', '_IMG_3036.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3741, 7461, 'Multi-Seat (unlimited)', '_IMG_1659.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3742, 7461, 'Small', '_IMG_1659.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3743, 7461, 'Unlimited Reproduction / Print Runs', '_IMG_1659.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3744, 7461, 'Medium', '_IMG_1659.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3745, 7461, 'Items for Resale (limited run)', '_IMG_1659.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3746, 7461, 'Large', '_IMG_1659.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3747, 7461, 'Electronic Items for Resale (unlimited run)', '_IMG_1659.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3748, 7461, 'Original size', '_IMG_1659.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3749, 7461, 'Extended Legal Guarantee covers up to $250,000', '_IMG_1659.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3721, 7457, 'Original size', '_IMG_2911.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3722, 7457, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2911.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3723, 7458, 'Multi-Seat (unlimited)', '_IMG_2975.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3724, 7458, 'Small', '_IMG_2975.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3725, 7458, 'Unlimited Reproduction / Print Runs', '_IMG_2975.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3726, 7458, 'Medium', '_IMG_2975.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3727, 7458, 'Items for Resale (limited run)', '_IMG_2975.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3728, 7458, 'Large', '_IMG_2975.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3729, 7458, 'Electronic Items for Resale (unlimited run)', '_IMG_2975.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3730, 7458, 'Original size', '_IMG_2975.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3731, 7458, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2975.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3732, 7459, 'Multi-Seat (unlimited)', '_IMG_3036.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3733, 7459, 'Small', '_IMG_3036.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3734, 7459, 'Unlimited Reproduction / Print Runs', '_IMG_3036.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3735, 7459, 'Medium', '_IMG_3036.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3736, 7459, 'Items for Resale (limited run)', '_IMG_3036.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3737, 7459, 'Large', '_IMG_3036.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3738, 7459, 'Electronic Items for Resale (unlimited run)', '_IMG_3036.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3739, 7459, 'Original size', '_IMG_3036.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3700, 7455, 'Items for Resale (limited run)', '_IMG_2735.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3701, 7455, 'Large', '_IMG_2735.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3702, 7455, 'Electronic Items for Resale (unlimited run)', '_IMG_2735.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3703, 7455, 'Original size', '_IMG_2735.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3704, 7455, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2735.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3705, 7456, 'Multi-Seat (unlimited)', '_IMG_2842.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3706, 7456, 'Small', '_IMG_2842.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3707, 7456, 'Unlimited Reproduction / Print Runs', '_IMG_2842.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3708, 7456, 'Medium', '_IMG_2842.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3709, 7456, 'Items for Resale (limited run)', '_IMG_2842.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3710, 7456, 'Large', '_IMG_2842.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3711, 7456, 'Electronic Items for Resale (unlimited run)', '_IMG_2842.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3712, 7456, 'Original size', '_IMG_2842.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3713, 7456, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2842.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3714, 7457, 'Multi-Seat (unlimited)', '_IMG_2911.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3715, 7457, 'Small', '_IMG_2911.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3716, 7457, 'Unlimited Reproduction / Print Runs', '_IMG_2911.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3717, 7457, 'Medium', '_IMG_2911.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3718, 7457, 'Items for Resale (limited run)', '_IMG_2911.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3719, 7457, 'Large', '_IMG_2911.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3720, 7457, 'Electronic Items for Resale (unlimited run)', '_IMG_2911.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(4943, 7658, 'MP3', 'audio2.mp3', 1, 1, 0, 4801);
INSERT INTO `items` VALUES(4939, 7657, 'MP3', 'audio1.mp3', 1, 1, 0, 4801);
INSERT INTO `items` VALUES(1738, 4839, 'Shipped CD', '', 100, 5, 1, 6787);
INSERT INTO `items` VALUES(1732, 4839, 'ZIP', 'vector.zip', 50, 0, 0, 6786);
INSERT INTO `items` VALUES(4942, 7657, 'Shipped CD', '', 10, 5, 1, 5893);
INSERT INTO `items` VALUES(4938, 7656, 'Shipped CD', '', 100, 5, 1, 6781);
INSERT INTO `items` VALUES(3777, 7465, 'Multi-Seat (unlimited)', '_IMG_1978.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3778, 7465, 'Small', '_IMG_1978.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3779, 7465, 'Unlimited Reproduction / Print Runs', '_IMG_1978.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3780, 7465, 'Medium', '_IMG_1978.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3781, 7465, 'Items for Resale (limited run)', '_IMG_1978.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3782, 7465, 'Large', '_IMG_1978.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3783, 7465, 'Electronic Items for Resale (unlimited run)', '_IMG_1978.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3784, 7465, 'Original size', '_IMG_1978.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3785, 7465, 'Extended Legal Guarantee covers up to $250,000', '_IMG_1978.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3786, 7466, 'Multi-Seat (unlimited)', '_IMG_3289.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3787, 7466, 'Small', '_IMG_3289.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3788, 7466, 'Unlimited Reproduction / Print Runs', '_IMG_3289.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3789, 7466, 'Medium', '_IMG_3289.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3674, 7452, 'Large', '_IMG_2634.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3675, 7452, 'Electronic Items for Resale (unlimited run)', '_IMG_2634.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3676, 7452, 'Original size', '_IMG_2634.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3677, 7452, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2634.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3678, 7453, 'Multi-Seat (unlimited)', '_IMG_2639.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3679, 7453, 'Small', '_IMG_2639.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3680, 7453, 'Unlimited Reproduction / Print Runs', '_IMG_2639.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3681, 7453, 'Medium', '_IMG_2639.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3682, 7453, 'Items for Resale (limited run)', '_IMG_2639.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3683, 7453, 'Large', '_IMG_2639.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3684, 7453, 'Electronic Items for Resale (unlimited run)', '_IMG_2639.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3685, 7453, 'Original size', '_IMG_2639.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3686, 7453, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2639.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3687, 7454, 'Multi-Seat (unlimited)', '_IMG_2691.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3688, 7454, 'Small', '_IMG_2691.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3689, 7454, 'Unlimited Reproduction / Print Runs', '_IMG_2691.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3690, 7454, 'Medium', '_IMG_2691.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3691, 7454, 'Items for Resale (limited run)', '_IMG_2691.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3692, 7454, 'Large', '_IMG_2691.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3693, 7454, 'Electronic Items for Resale (unlimited run)', '_IMG_2691.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3694, 7454, 'Original size', '_IMG_2691.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3695, 7454, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2691.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3696, 7455, 'Multi-Seat (unlimited)', '_IMG_2735.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3697, 7455, 'Small', '_IMG_2735.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3698, 7455, 'Unlimited Reproduction / Print Runs', '_IMG_2735.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3699, 7455, 'Medium', '_IMG_2735.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3660, 7451, 'Multi-Seat (unlimited)', '_IMG_2381.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3661, 7451, 'Small', '_IMG_2381.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3662, 7451, 'Unlimited Reproduction / Print Runs', '_IMG_2381.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3663, 7451, 'Medium', '_IMG_2381.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3664, 7451, 'Items for Resale (limited run)', '_IMG_2381.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(3665, 7451, 'Large', '_IMG_2381.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(3666, 7451, 'Electronic Items for Resale (unlimited run)', '_IMG_2381.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(3667, 7451, 'Original size', '_IMG_2381.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(3668, 7451, 'Extended Legal Guarantee covers up to $250,000', '_IMG_2381.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(3669, 7452, 'Multi-Seat (unlimited)', '_IMG_2634.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(3670, 7452, 'Small', '_IMG_2634.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(3671, 7452, 'Unlimited Reproduction / Print Runs', '_IMG_2634.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(3672, 7452, 'Medium', '_IMG_2634.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(3673, 7452, 'Items for Resale (limited run)', '_IMG_2634.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(2284, 7011, 'ZIP', 'cd.zip', 5, 2, 0, 4804);
INSERT INTO `items` VALUES(2285, 7011, 'Shipped CD', '', 10, 5, 1, 5894);
INSERT INTO `items` VALUES(2286, 7011, 'Shipped CD', '', 100, 5, 1, 6787);
INSERT INTO `items` VALUES(2663, 7176, 'Shipped CD', '', 10, 5, 1, 5894);
INSERT INTO `items` VALUES(2664, 7176, 'Shipped CD', '', 100, 5, 1, 6787);
INSERT INTO `items` VALUES(5062, 7673, 'Extended Legal Guarantee covers up to $250,000', '_IMG_0783_iptc.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(5060, 7673, 'Electronic Items for Resale (unlimited run)', '_IMG_0783_iptc.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(5061, 7673, 'Original size', '_IMG_0783_iptc.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(5058, 7673, 'Items for Resale (limited run)', '_IMG_0783_iptc.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(4515, 7589, 'Extended Legal Guarantee covers up to $250,000', '_IMG_0811.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(4514, 7589, 'Original size', '_IMG_0811.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(4512, 7589, 'Large', '_IMG_0811.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(4513, 7589, 'Electronic Items for Resale (unlimited run)', '_IMG_0811.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(4510, 7589, 'Medium', '_IMG_0811.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(4511, 7589, 'Items for Resale (limited run)', '_IMG_0811.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(4508, 7589, 'Small', '_IMG_0811.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(4509, 7589, 'Unlimited Reproduction / Print Runs', '_IMG_0811.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(4507, 7589, 'Multi-Seat (unlimited)', '_IMG_0811.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(4506, 7588, 'Extended Legal Guarantee covers up to $250,000', '_IMG_0802.JPG', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(4505, 7588, 'Original size', '_IMG_0802.JPG', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(4496, 7587, 'Original size', '_IMG_0783_iptc.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(4497, 7587, 'Extended Legal Guarantee covers up to $250,000', '_IMG_0783_iptc.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(4498, 7588, 'Multi-Seat (unlimited)', '_IMG_0802.JPG', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(4499, 7588, 'Small', '_IMG_0802.JPG', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(4500, 7588, 'Unlimited Reproduction / Print Runs', '_IMG_0802.JPG', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(4501, 7588, 'Medium', '_IMG_0802.JPG', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(4502, 7588, 'Items for Resale (limited run)', '_IMG_0802.JPG', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(4503, 7588, 'Large', '_IMG_0802.JPG', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(4504, 7588, 'Electronic Items for Resale (unlimited run)', '_IMG_0802.JPG', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(4495, 7587, 'Electronic Items for Resale (unlimited run)', '_IMG_0783_iptc.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(4494, 7587, 'Large', '_IMG_0783_iptc.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(4493, 7587, 'Items for Resale (limited run)', '_IMG_0783_iptc.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(4492, 7587, 'Medium', '_IMG_0783_iptc.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(4491, 7587, 'Unlimited Reproduction / Print Runs', '_IMG_0783_iptc.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(4489, 7587, 'Multi-Seat (unlimited)', '_IMG_0783_iptc.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(4490, 7587, 'Small', '_IMG_0783_iptc.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(5059, 7673, 'Large', '_IMG_0783_iptc.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(5057, 7673, 'Medium', '_IMG_0783_iptc.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(5056, 7673, 'Unlimited Reproduction / Print Runs', '_IMG_0783_iptc.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(5045, 7672, 'Multi-Seat (unlimited)', 'IMG_1608.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(5046, 7672, 'Small', 'IMG_1608.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(5047, 7672, 'Unlimited Reproduction / Print Runs', 'IMG_1608.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(5048, 7672, 'Medium', 'IMG_1608.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(5049, 7672, 'Items for Resale (limited run)', 'IMG_1608.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(5050, 7672, 'Large', 'IMG_1608.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(5051, 7672, 'Electronic Items for Resale (unlimited run)', 'IMG_1608.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(5052, 7672, 'Original size', 'IMG_1608.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(5053, 7672, 'Extended Legal Guarantee covers up to $250,000', 'IMG_1608.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(5054, 7673, 'Multi-Seat (unlimited)', '_IMG_0783_iptc.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(5055, 7673, 'Small', '_IMG_0783_iptc.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(5042, 7671, 'Electronic Items for Resale (unlimited run)', '_IMG_0783_iptc.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(5043, 7671, 'Original size', '_IMG_0783_iptc.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(5044, 7671, 'Extended Legal Guarantee covers up to $250,000', '_IMG_0783_iptc.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(5041, 7671, 'Large', '_IMG_0783_iptc.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(5040, 7671, 'Items for Resale (limited run)', '_IMG_0783_iptc.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(5039, 7671, 'Medium', '_IMG_0783_iptc.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(5038, 7671, 'Unlimited Reproduction / Print Runs', '_IMG_0783_iptc.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(5035, 7670, 'Extended Legal Guarantee covers up to $250,000', 'IMG_1608.jpg', 100, 5, 0, 6893);
INSERT INTO `items` VALUES(5036, 7671, 'Multi-Seat (unlimited)', '_IMG_0783_iptc.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(5037, 7671, 'Small', '_IMG_0783_iptc.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(5031, 7670, 'Items for Resale (limited run)', 'IMG_1608.jpg', 125, 3, 0, 6891);
INSERT INTO `items` VALUES(5032, 7670, 'Large', 'IMG_1608.jpg', 3, 3, 0, 6887);
INSERT INTO `items` VALUES(5033, 7670, 'Electronic Items for Resale (unlimited run)', 'IMG_1608.jpg', 125, 4, 0, 6892);
INSERT INTO `items` VALUES(5034, 7670, 'Original size', 'IMG_1608.jpg', 4, 4, 0, 6888);
INSERT INTO `items` VALUES(5029, 7670, 'Unlimited Reproduction / Print Runs', 'IMG_1608.jpg', 125, 2, 0, 6890);
INSERT INTO `items` VALUES(5030, 7670, 'Medium', 'IMG_1608.jpg', 2, 2, 0, 6886);
INSERT INTO `items` VALUES(4946, 7658, 'Shipped CD', '', 10, 5, 1, 5893);
INSERT INTO `items` VALUES(5027, 7670, 'Multi-Seat (unlimited)', 'IMG_1608.jpg', 75, 1, 0, 6889);
INSERT INTO `items` VALUES(5028, 7670, 'Small', 'IMG_1608.jpg', 1, 1, 0, 6885);
INSERT INTO `items` VALUES(4937, 7656, 'Shipped CD', '', 10, 5, 1, 5892);
INSERT INTO `items` VALUES(4936, 7656, 'MP4', 'video2.mp4', 5, 0, 0, 6784);
INSERT INTO `items` VALUES(4934, 7655, 'Shipped CD', '', 100, 5, 1, 6781);
INSERT INTO `items` VALUES(4935, 7656, 'MP4', 'video2.mp4', 40, 0, 0, 6786);
INSERT INTO `items` VALUES(4933, 7655, 'Shipped CD', '', 10, 5, 1, 5892);
INSERT INTO `items` VALUES(4932, 7655, 'MP4', 'video.mp4', 5, 0, 0, 6784);
INSERT INTO `items` VALUES(4931, 7655, 'MP4', 'video.mp4', 40, 0, 0, 6786);
INSERT INTO `items` VALUES(5259, 7713, 'Shipped CD', '', 100, 5, 1, 6787);
INSERT INTO `items` VALUES(5258, 7713, 'Shipped CD', '', 10, 5, 1, 5894);
INSERT INTO `items` VALUES(5257, 7713, 'ZIP', 'cd.zip', 5, 2, 0, 4804);



CREATE TABLE `languages` (
  `name` varchar(250) default NULL,
  `display` int(11) default NULL,
  `activ` int(11) default NULL,
  `metatags` varchar(100) default NULL
);



INSERT INTO `languages` VALUES('English', 1, 1, 'utf-8');
INSERT INTO `languages` VALUES('French', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('German', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Italian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Portuguese', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Spanish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Russian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Swedish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Chinese simplified', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Catalan', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Arabic', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Malaysian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Bulgarian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Polish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Japanese', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Greek', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Dutch', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Norwegian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Finnish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Czech', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Estonian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Serbian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Hungarian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Danish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Romanian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Hebrew', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Indonesian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Chinese traditional', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Afrikaans formal', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Afrikaans informal', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Slovakian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Persian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Latvian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Slovenian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Lithuanian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Turkish', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Thai', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Brazilian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Ukrainian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Georgian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Croatian', 1, 0, 'utf-8');
INSERT INTO `languages` VALUES('Icelandic', 1, 0, 'utf-8');



CREATE TABLE `licenses` (
  `id_parent` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `description` text,
  `priority` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`)
);



INSERT INTO `licenses` VALUES(4583, 'Standard', '<p>Description of Royalty Free license.</p>', 1);
INSERT INTO `licenses` VALUES(4584, 'Extended', 'Description of Extended license.<br />', 2);



CREATE TABLE `lightboxes` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) default NULL,
  `description` text,
  PRIMARY KEY  (`id`),
  KEY `title` (`title`)
);


INSERT INTO `lightboxes` VALUES(3, 'Trees', '');
INSERT INTO `lightboxes` VALUES(4, 'Cities', '');
INSERT INTO `lightboxes` VALUES(7, 'My lightbox', '');
INSERT INTO `lightboxes` VALUES(8, 'Premium', '');
INSERT INTO `lightboxes` VALUES(10, 'Excellent photos', '');
INSERT INTO `lightboxes` VALUES(11, 'Common', '');
INSERT INTO `lightboxes` VALUES(12, 'Wow', '');

            

CREATE TABLE `lightboxes_admin` (
  `id_parent` int(11) default NULL,
  `user` int(11) default NULL,
  `user_owner` tinyint(4) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `user` (`user`),
  KEY `user_owner` (`user_owner`)
);



INSERT INTO `lightboxes_admin` VALUES(3, 3931, 1);
INSERT INTO `lightboxes_admin` VALUES(4, 3931, 1);
INSERT INTO `lightboxes_admin` VALUES(12, 7403, 1);
INSERT INTO `lightboxes_admin` VALUES(11, 7403, 1);
INSERT INTO `lightboxes_admin` VALUES(7, 6355, 1);
INSERT INTO `lightboxes_admin` VALUES(8, 6355, 1);
INSERT INTO `lightboxes_admin` VALUES(10, 3931, 0);
INSERT INTO `lightboxes_admin` VALUES(10, 4131, 1);
INSERT INTO `lightboxes_admin` VALUES(7, 4131, 0);
INSERT INTO `lightboxes_admin` VALUES(7, 4132, 0);



CREATE TABLE `lightboxes_files` (
  `id_parent` int(11) default NULL,
  `item` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `item` (`item`)
);



INSERT INTO `lightboxes_files` VALUES(3, 7465);
INSERT INTO `lightboxes_files` VALUES(10, 7471);
INSERT INTO `lightboxes_files` VALUES(3, 7466);
INSERT INTO `lightboxes_files` VALUES(12, 7176);
INSERT INTO `lightboxes_files` VALUES(12, 7471);
INSERT INTO `lightboxes_files` VALUES(11, 7471);
INSERT INTO `lightboxes_files` VALUES(12, 7464);
INSERT INTO `lightboxes_files` VALUES(11, 7713);
INSERT INTO `lightboxes_files` VALUES(4, 7470);
INSERT INTO `lightboxes_files` VALUES(3, 7469);
INSERT INTO `lightboxes_files` VALUES(4, 7465);
INSERT INTO `lightboxes_files` VALUES(3, 7468);
INSERT INTO `lightboxes_files` VALUES(12, 7468);
INSERT INTO `lightboxes_files` VALUES(7, 7465);
INSERT INTO `lightboxes_files` VALUES(8, 7471);
INSERT INTO `lightboxes_files` VALUES(7, 7451);
INSERT INTO `lightboxes_files` VALUES(7, 7471);
INSERT INTO `lightboxes_files` VALUES(3, 7471);
INSERT INTO `lightboxes_files` VALUES(12, 7451);
INSERT INTO `lightboxes_files` VALUES(12, 7658);
INSERT INTO `lightboxes_files` VALUES(11, 7464);



CREATE TABLE `messages` (
  `id_parent` int(11) NOT NULL auto_increment,
  `touser` varchar(200) default NULL,
  `fromuser` varchar(200) default NULL,
  `subject` varchar(200) default NULL,
  `content` text,
  `data` int(11) default NULL,
  `viewed` int(11) default NULL,
  `trash` int(11) default NULL,
  `del` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `touser` (`touser`),
  KEY `fromuser` (`fromuser`),
  KEY `data` (`data`)
);



INSERT INTO `messages` VALUES(4143, 'john', 'demo', 'Hi', 'Hi John & Boby!\r\n\r\nHow a re you?\r\n\r\nThank you,\r\ndemo', 1193657959, 0, 0, 0);
INSERT INTO `messages` VALUES(4142, 'siteowner', 'demo', 'Hi', 'Hi John & Boby!\r\n\r\nHow a re you?\r\n\r\nThank you,\r\ndemo', 1193657959, 0, 0, 0);
INSERT INTO `messages` VALUES(4146, 'demo', 'siteowner', 'Salut!', 'How are you?\r\n\r\nBoby', 1193828492, 1, 0, 0);
INSERT INTO `messages` VALUES(4147, 'demo', 'john', 'New topic', 'Where are you?\r\n\r\nJohn', 1193829019, 1, 1, 0);
INSERT INTO `messages` VALUES(4148, 'siteowner', 'demo', 'Re: Salut!', 'I am fine.\r\nThanks\r\n\r\n\r\n\r\n\r\nYou wrote: 10/31/2007 14:01:32\r\nHow are you?\r\n\r\nBoby', 1193861398, 0, 0, 0);
INSERT INTO `messages` VALUES(4776, 'demo', 'Site Administration', 'Test Newsletter!', 'Hi everybody!', 1216833339, 1, 1, 1);
INSERT INTO `messages` VALUES(4778, 'siteowner', 'Site Administration', 'Test Newsletter!', 'Hi everybody!', 1216833339, 0, 0, 0);
INSERT INTO `messages` VALUES(4779, 'john', 'Site Administration', 'Test Newsletter!', 'Hi everybody!', 1216833339, 0, 0, 0);



CREATE TABLE `models` (
  `id_parent` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `description` text,
  `user` varchar(200) default NULL,
  `model` varchar(200) default NULL,
  `modelphoto` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `user` (`user`),
  KEY `name` (`name`)
);



INSERT INTO `models` VALUES(6205, 'Model 1', 'Description of Model 1', 'demo', '/content/models/model6205.jpg', '/content/models/modelphoto6205.JPG');



CREATE TABLE `navigation` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `url` varchar(200) default NULL,
  `priority` int(11) default NULL
);



INSERT INTO `navigation` VALUES(4016, 'About', '/pages/about.html', 2);
INSERT INTO `navigation` VALUES(4017, 'News', '/news/', 3);
INSERT INTO `navigation` VALUES(4018, 'Contacts', '/contacts/', 4);
INSERT INTO `navigation` VALUES(4020, 'About', '/pages/about.html', 2);
INSERT INTO `navigation` VALUES(4021, 'News', '/news/', 3);
INSERT INTO `navigation` VALUES(4022, 'Contacts', '/contacts/', 4);



CREATE TABLE `news` (
  `id_parent` int(11) NOT NULL auto_increment,
  `announce` text,
  `content` text,
  `data` int(11) default NULL,
  `title` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`)
);



INSERT INTO `news` VALUES(3925, 'The new version of Photo Video Selling Software is available. Two new templates were added.\r\n', '', 1341666595, 'Version 12.06 released');
INSERT INTO `news` VALUES(3926, 'The new version of Photo Video Store software has been released: a new templates, a new admin panel, html format for emails.', '', 1352815920, 'New version 12.10 ');
INSERT INTO `news` VALUES(3927, 'The new version of Photo Video Selling script has been released: one new template, auto paging, new taxes/shipping/prints systems and many other features.', '', 1366722782, 'Version 13.04');



CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL auto_increment,
  `data` int(11) default NULL,
  `touser` varchar(100) default NULL,
  `types` varchar(50) default NULL,
  `subject` varchar(250) default NULL,
  `content` text,
  `html` tinyint(4) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `newsletter` VALUES(4, 1216833339, 'newsletter', 'message', 'Test Newsletter!', 'Hi everybody!', NULL);
INSERT INTO `newsletter` VALUES(7, 1360423685, 'seller_newsletter', 'message', 'New newsletter', '<p>Test</p>\r\n<p>&nbsp;</p>', 1);



CREATE TABLE `notifications` (
  `events` varchar(30) default NULL,
  `title` varchar(250) default NULL,
  `message` text,
  `enabled` int(11) default NULL,
  `priority` int(11) default NULL,
  `subject` varchar(250) default NULL,
  `html` tinyint(4) default NULL,
  KEY `priority` (`priority`),
  KEY `events` (`events`)
);



INSERT INTO `notifications` VALUES('contacts_to_admin', 'Contact email to admin', '{lang.Name}: {NAME}\r\n{lang.E-mail}: {EMAIL}\r\n{lang.Telephone}: {TELEPHONE}\r\n{lang.Method}: {METHOD}\r\n{lang.Question}: {QUESTION}\r\n{lang.Date}: {DATE}', 1, 10, 'Contact Us on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('contacts_to_user', 'Contacts response to user', 'Thank you, {NAME}. Your message has been received. We will response stortly.\r\n\r\nBest regards,\r\n{SITE_NAME}', 1, 20, 'Re: Contact Us on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('fraud_to_user', 'Fraud auth email to user', 'Hello {NAME},\r\n\r\nSomebody unsuccessfully tried to log in to your account several times. We have changed your password. It is security issue.\r\n\r\n\r\nYour NEW password:  {NEWPASSWORD}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 30, 'You password has been changed on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('neworder_to_user', 'New order email to user', 'Hello {NAME},\r\n\r\nThanks for buying on {SITE_NAME}! We will _char_ge and ship your order soon. \r\n\r\n{lang.Order} _resh_ {ORDER}\r\n{lang.Date}: {DATE}\r\n\r\n{ITEM_LIST}\r\n\r\n{lang.Subtotal}: {SUBTOTAL}\r\n{lang.Discount}: {DISCOUNT}\r\n{lang.Shipping}: {SHIPPING}\r\n{lang.Taxes}: {TAXES}\r\n{lang.Total}: {TOTAL}\r\n\r\n\r\n{lang.Billing address}\r\n{BILLING_FIRSTNAME} {BILLING_LASTNAME}\r\n{BILLING_ADDRESS}\r\n{BILLING_CITY} {BILLING_ZIP}, {BILLING_COUNTRY}\r\n\r\n\r\n{lang.Shipping address}\r\n{SHIPPING_FIRSTNAME} {SHIPPING_LASTNAME}\r\n{SHIPPING_ADDRESS}\r\n{SHIPPING_CITY} {SHIPPING_ZIP}, {SHIPPING_COUNTRY}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 40, 'Order _resh_ {ORDER_ID} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('neworder_to_admin', 'New order email to admin', '{lang.Order} _resh_ {ORDER}\r\n{lang.date}: {DATE}\r\n\r\n{ITEM_LIST}\r\n\r\n{lang.Subtotal}: {SUBTOTAL}\r\n{lang.Discount}: {DISCOUNT}\r\n{lang.Shipping}: {SHIPPING}\r\n{lang.Taxes}: {TAXES}\r\n{lang.Total}: {TOTAL}\r\n\r\n{WORD_CUSTOMER_ID}: {CUSTOMERID}\r\n{lang.Login}: {LOGIN}\r\n{lang.Name}: {NAME}\r\n{lang.E-mail}: {EMAIL}\r\n{lang.Telephone}: {TELEPHONE}\r\n\r\n\r\n{lang.Billing address}\r\n{BILLING_FIRSTNAME} {BILLING_LASTNAME}\r\n{BILLING_ADDRESS}\r\n{BILLING_CITY} {BILLING_ZIP}, {BILLING_COUNTRY}\r\n\r\n\r\n{lang.Shiping address}\r\n{SHIPPING_FIRSTNAME} {SHIPPING_LASTNAME}\r\n{SHIPPING_ADDRESS}\r\n{SHIPPING_CITY} {SHIPPING_ZIP}, {SHIPPING_COUNTRY}', 1, 50, 'Order _resh_ {ORDER_ID} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('signup_to_admin', 'New signup email to admin', 'There is a new registration on {SITE_NAME}:\r\n\r\n{lang.Login}: {LOGIN}\r\n{lang.Name}: {NAME}\r\n{lang.E-mail}: {EMAIL}\r\n{lang.Telephone}: {TELEPHONE}\r\n{lang.Address}: {ADDRESS}\r\n{lang.City}: {CITY}\r\n{lang.Country}: {COUNTRY}\r\n{lang.Date}: {DATE}', 1, 60, 'Registration on  {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('signup_to_user', 'New signup email to user', 'Hi {NAME},\r\n\r\nThank you for your registration on {SITE_NAME}\r\nPlease, click next link: {CONFIRMATION_LINK} to confirm your registration.\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 70, 'Registration on  {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('forgot_password', 'Forgot password email to user', 'Hello {NAME},\r\n\r\nThe following Password will allow you to access your {SITE_NAME} profile.  The Login and Password are two codes and are not publicly shown or known.\r\n\r\nYour login:  {LOGIN}\r\nPassword: {PASSWORD}\r\n\r\nYou can change your password after you log into {SITE_NAME}.\r\n\r\nIf you have any problems accessing your profile, please let us know.\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 80, 'The password on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('tell_a_friend', 'Tell a friend email', 'Hello {NAME2},\r\n\r\nYour friend, {NAME} at {EMAIL}, recommended this link: {URL}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 90, 'Tell a friend about {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('subscription_to_admin', 'New subscription email to admin', '{SUBSCRIPTION_DETAILS}\r\n{lang.Date}: {DATE}\r\n\r\n{lang.Login}: {LOGIN}\r\n{lang.Name}: {NAME}\r\n{lang.E-mail}: {EMAIL}\r\n{lang.Telephone}: {TELEPHONE}\r\n{lang.Address}: {ADDRESS}\r\n{lang.Country}: {COUNTRY}', 1, 53, 'Subscription order {SUBSCRIPTION} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('subscription_to_user', 'New subscription email to user', 'Hello {NAME},\r\n\r\nThanks for buying a subscription on {SITE_NAME}! \r\n\r\n{SUBSCRIPTION_DETAILS}\r\n{lang.DATE}: {DATE}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 52, 'Subscription order {SUBSCRIPTION} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('credits_to_admin', 'New credits email to admin', '{CREDITS_DETAILS}\r\n{lang.Date}: {DATE}\r\n\r\n{lang.Login}: {LOGIN}\r\n{lang.Name}: {NAME}\r\n{lang.E-mail}: {EMAIL}\r\n{lang.Telephone}: {TELEPHONE}\r\n{lang.Address}: {ADDRESS}\r\n{lang.Country}: {COUNTRY}', 1, 55, 'Credits order {CREDITS} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('credits_to_user', 'New credits email to user', 'Hello {NAME},\r\n\r\nThanks for buying a credits on {SITE_NAME}! \r\n\r\n{CREDITS_DETAILS}\r\n{lang.Date}: {DATE}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 54, 'Credits order {CREDITS} on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('signup_guest', 'New signup email to guest', 'Hi,\r\n\r\nThank you for your registration on {SITE_NAME}\r\nYour login: {LOGIN}\r\nPassword: {PASSWORD}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 75, 'Registration on  {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('commission_to_seller', 'New commission to seller', 'Hello {NAME},\r\n\r\nThere is a new sale at {SITE_NAME}.\r\n\r\n{lang.File}: {FILE}\r\n{lang.Order}: {ORDER_ID}\r\n{lang.Earning}: {EARNING}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 95, 'New sale on  {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('commission_to_affiliate', 'New commission to affiliate', 'Hello {NAME},\r\n\r\nThere is a new sale at {SITE_NAME}.\r\n{lang.Order}: {ORDER_ID}\r\n{lang.Earning}: {EARNING}\r\n\r\nThank you,\r\n{SITE_NAME}', 1, 105, 'New sale on  {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('exam_to_admin', 'New examination to admin', 'The user took an examination.\r\n\r\nLogin: {LOGIN}\r\nDate: {DATE}\r\nID: {ID}', 1, 110, 'New examination on {SITE_NAME}', 1);
INSERT INTO `notifications` VALUES('exam_to_seller', 'New examination to seller', 'Hello {NAME},\r\n\r\nThank you for taking an examination at {SITE_NAME}!\r\n\r\nResult: {RESULT}\r\nDate: {DATE}\r\nComments: {COMMENTS}\r\n\r\nBest regards,\r\n{SITE_NAME}', 1, 115, 'The examination on {SITE_NAME}', 1);



CREATE TABLE `orders` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) default NULL,
  `total` float default NULL,
  `status` int(11) default NULL,
  `payment` int(11) default NULL,
  `data` int(11) default NULL,
  `subtotal` float default NULL,
  `discount` float default NULL,
  `shipping` float default NULL,
  `tax` float default NULL,
  `shipping_firstname` varchar(100) default NULL,
  `shipping_lastname` varchar(100) default NULL,
  `shipping_address` varchar(200) default NULL,
  `shipping_country` varchar(100) default NULL,
  `shipping_city` varchar(100) default NULL,
  `shipping_zip` varchar(100) default NULL,
  `shipped` int(11) default NULL,
  `billing_firstname` varchar(100) default NULL,
  `billing_lastname` varchar(100) default NULL,
  `billing_address` varchar(200) default NULL,
  `billing_country` varchar(100) default NULL,
  `billing_city` varchar(100) default NULL,
  `billing_zip` varchar(100) default NULL,
  `shipping_method` int(11) default NULL,
  `shipping_state` varchar(250) default NULL,
  `billing_state` varchar(250) default NULL,
  `weight` float default NULL,
  PRIMARY KEY  (`id`),
  KEY `user` (`user`)
);



INSERT INTO `orders` VALUES(119, 6355, 1, 1, 0, 1345648660, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(120, 6355, 2.5, 1, 0, 1348159108, 2.5, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(100, 6355, 2, 1, 0, 1321957627, 2, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(101, 6355, 9, 1, 0, 1321958964, 9, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(102, 6355, 1, 1, 0, 1326904633, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(103, 6355, 1, 0, 0, 1329918423, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(104, 6355, 1, 0, 0, 1329918756, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(105, 6355, 1, 0, 0, 1329918963, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(111, 6355, 125, 1, 0, 1340960823, 125, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(118, 6355, 3, 0, 0, 1345648241, 3, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(117, 6355, 2, 1, 0, 1344945805, 2, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(122, 6355, 2, 1, 0, 1352801009, 2, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(123, 6355, 1, 1, 0, 1355489344, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(129, 7435, 1, 1, 0, 1360580757, 1, 0, 0, 0, 'seller2', 'seller2', '', 'Austria', '', '', 0, 'seller2', 'seller2', '', 'Austria', '', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(128, 4113, 1, 1, 0, 1359828517, 1, 0, 0, 0, 'Jeff', 'Ri_char_ds', '1st Rd.', 'USA', 'New York', '12345', 0, 'Jeff', 'Ri_char_ds', '1st Rd.', 'USA', 'New York', '12345', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(130, 6355, 4, 1, 0, 1362832950, 4, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, NULL, NULL, NULL);
INSERT INTO `orders` VALUES(148, 6355, 1.1, 0, 0, 1376476285, 1, 0, 0, 0.1, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(146, 6355, 1, 1, 0, 1372075943, 1, 0, 0, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(147, 7403, 1, 1, 0, 1376066670, 1, 0, 0, 0, 'Bob', 'Smith', '', 'Austria', 'Wien', '', 0, 'Bob', 'Smith', '', 'Austria', 'Wien', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(134, 6355, 18, 1, 0, 1365409882, 17, 0, 1, 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 6, '', '', 0.202);
INSERT INTO `orders` VALUES(149, 6355, 1.1, 0, 0, 1376577474, 1, 0, 0, 0.1, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(142, 6355, 9, 1, 0, 1366019007, 8, 0, 1, 0, 'John', 'Brown', 'test', 'United States', 'Los Angeles', 'test', 0, 'John', 'Brown', 'test', 'United States', 'Los Angeles', 'test', 6, '', '', 0.005);
INSERT INTO `orders` VALUES(150, 6355, 1.1, 0, 0, 1376577555, 1, 0, 0, 0.1, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(151, 6355, 1.1, 0, 0, 1376577612, 1, 0, 0, 0.1, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, 'John', 'Brown', '', 'United States', 'Los Angeles', '', 0, '', '', 0);
INSERT INTO `orders` VALUES(152, 7440, 1.1, 0, 0, 1376838034, 1, 0, 0, 0.1, 'Guest', 'Guest', '', 'United States', '', '', 0, 'Guest', 'Guest', '', 'United States', '', '', 0, '', '', 0);



CREATE TABLE `orders_content` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `price` float default NULL,
  `item` int(11) default NULL,
  `quantity` int(11) default NULL,
  `prints` int(11) default NULL,
  `option1_id` int(11) default NULL,
  `option1_value` varchar(200) default NULL,
  `option2_id` int(11) default NULL,
  `option2_value` varchar(200) default NULL,
  `option3_id` int(11) default NULL,
  `option3_value` varchar(200) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `id_parent_2` (`id_parent`),
  KEY `prints` (`prints`)
);



INSERT INTO `orders_content` VALUES(273, 120, 2.5, 3834, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(271, 118, 3, 3746, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(263, 111, 125, 3833, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(257, 105, 1, 3796, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(256, 104, 1, 3769, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(272, 119, 1, 3769, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(284, 129, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(277, 123, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(276, 122, 1, 3823, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(275, 122, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(269, 117, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(270, 117, 1, 3778, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(283, 128, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(255, 103, 1, 3787, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(254, 102, 1, 3778, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(253, 101, 5, 957, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(252, 101, 1, 1098, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(251, 101, 3, 1094, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(250, 100, 1, 3787, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(249, 100, 1, 3778, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(285, 130, 4, 3838, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(317, 148, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(316, 147, 1, 3778, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(299, 134, 3, 3836, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(298, 134, 11, 9111, 1, 1, 4, 'Black', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(297, 134, 2, 8194, 1, 1, 1, 'Glossy', 6, 'Yes', 0, '');
INSERT INTO `orders_content` VALUES(311, 142, 2, 8152, 1, 1, 1, 'Matte', 6, 'No', 0, '');
INSERT INTO `orders_content` VALUES(310, 142, 3, 8171, 2, 1, 1, 'Matte', 6, 'No', 0, '');
INSERT INTO `orders_content` VALUES(315, 146, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(318, 149, 1, 3832, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(319, 150, 1, 3823, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(320, 151, 1, 3814, 1, 0, 0, '', 0, '', 0, '');
INSERT INTO `orders_content` VALUES(321, 152, 1, 3832, 1, 0, 0, '', 0, '', 0, '');



CREATE TABLE `pages` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `content` text,
  `priority` int(11) default NULL,
  `link` varchar(200) default NULL,
  `url` varchar(250) default NULL,
  `siteinfo` tinyint(4) default NULL,
  KEY `priority` (`priority`),
  KEY `id_parent` (`id_parent`),
  KEY `siteinfo` (`siteinfo`)
);



INSERT INTO `pages` VALUES(15, 'Sign Up', '<p> Please, fill in the form below:</p>', 8, 'signup', '/pages/sign-up.html', 0);
INSERT INTO `pages` VALUES(36, 'Forgot password', '<p>Please, entry your email.</p>\r\n<p>&nbsp;</p>', 7, 'forgot', '/pages/forgot-password.html', 0);
INSERT INTO `pages` VALUES(4334, 'Terms and Conditions', 'Terms and conditions<br /><br />Information...<br />', 9, 'terms', '/pages/terms-and-conditions.html', 0);
INSERT INTO `pages` VALUES(4035, 'About', '<p>{if english}</p>\r\n<p>Text about your company...</p>\r\n<p>{/if} {if french}</p>\r\n<p>La description du site...</p>\r\n<p>{/if}</p>\r\n<p>&nbsp;&nbsp;</p>\r\n<p>&nbsp;</p>', 1, '', '/pages/about.html', 1);
INSERT INTO `pages` VALUES(4036, 'Support', 'Text about support<br />', 2, '', '/pages/support.html', 1);
INSERT INTO `pages` VALUES(4037, 'Privacy Policy', 'Text about policy', 3, NULL, '/pages/privacy-policy.html', 1);
INSERT INTO `pages` VALUES(4038, 'FAQ', ' <p>FAQ page</p>', 4, NULL, '/pages/faq.html', 1);
INSERT INTO `pages` VALUES(4039, 'Contacts', '<br />', 5, '/contacts/', '/pages/contacts.html', 1);
INSERT INTO `pages` VALUES(6288, 'Examination', 'To become a seller you should upload several examples of your artworks for the examination. Our staff will view the files and decide if they are appropriate for our site and can be sold here.<br /><br />Please upload 10 photos first. <br />', 10, 'examination', '/pages/examination.html', 0);
INSERT INTO `pages` VALUES(6345, 'Examination - Thank you', 'Thank you! We will check the files and let you know if you can sell your artworks on our site.', 11, 'take_exam', '/pages/6345.html', 0);
INSERT INTO `pages` VALUES(6353, 'Buyer agreement', 'This Membership Agreement governs your membership in the YourSite.com community, allowing you full access to the membership portions of the web site located at (the \\"Site\\"). This Membership Agreement is in addition to the Terms of Use applicable to the Site. The Site is operated by YourSite.<br /><br />Access and use of the membership portions of the Site are provided by YourSite to you on condition that you accept the terms and conditions of this Membership Agreement and the Terms of Use, and by accessing or using the membership portions of the Site, you agree to the terms and conditions of this Membership Agreement and the Terms of Use. If you do not agree to accept and abide by this Membership Agreement and the Terms of Use, you should not access or use the membership portions of the Site. In the event of any inconsistency between this Membership Agreement and the Terms of Use, the terms of this Membership Agreement shall govern.<br /><br />YourSite reserves the right, in its discretion, to change or modify all or any part of this Membership Agreement at any time, effective immediately upon notice published on the Site. Your continued use of the membership portions of the Site after such notice constitutes your binding acceptance of the terms and conditions in this Membership Agreement, including any changes or modifications made by YourSite as permitted above. If at any time the terms and conditions of this Membership Agreement are no longer acceptable to you, you should immediately cease use of the membership portions of the Site.<strong><br /><br /></strong>', 12, 'buyer', '/pages/buyer-agreement.html', 0);
INSERT INTO `pages` VALUES(6354, 'Seller agreement', 'This Membership Agreement governs your membership in the YourSite.com community, allowing you full access to the membership portions of the web site located at (the \\"Site\\"). This Membership Agreement is in addition to the Terms of Use applicable to the Site. The Site is operated by YourSite.<br /><br />Access and use of the membership portions of the Site are provided by YourSite to you on condition that you accept the terms and conditions of this Membership Agreement and the Terms of Use, and by accessing or using the membership portions of the Site, you agree to the terms and conditions of this Membership Agreement and the Terms of Use. If you do not agree to accept and abide by this Membership Agreement and the Terms of Use, you should not access or use the membership portions of the Site. In the event of any inconsistency between this Membership Agreement and the Terms of Use, the terms of this Membership Agreement shall govern.<br /><br />YourSite reserves the right, in its discretion, to change or modify all or any part of this Membership Agreement at any time, effective immediately upon notice published on the Site. Your continued use of the membership portions of the Site after such notice constitutes your binding acceptance of the terms and conditions in this Membership Agreement, including any changes or modifications made by YourSite as permitted above. If at any time the terms and conditions of this Membership Agreement are no longer acceptable to you, you should immediately cease use of the membership portions of the Site.<br /><br />', 13, 'seller', '/pages/seller-agreement.html', 0);
INSERT INTO `pages` VALUES(6359, 'Seller lecture', 'Text of seller\\''s lecture....', 14, 'lecture', '/pages/seller-lecture.html', 0);
INSERT INTO `pages` VALUES(7278, 'Affiliate agreement', 'Affiliate agreement...', 15, 'affiliate', '/pages/affiliate-agreement.html', 0);
INSERT INTO `pages` VALUES(7498, 'Customer agreement', 'Customer agreement for the buyers, sellers and affiliates...<br />', 16, 'common', '/pages/customer-agreement.html', 0);



CREATE TABLE `payments` (
  `id_parent` int(11) NOT NULL auto_increment,
  `user` varchar(200) default NULL,
  `data` int(11) default NULL,
  `total` float default NULL,
  `ip` varchar(200) default NULL,
  `tnumber` varchar(200) default NULL,
  `ptype` varchar(200) default NULL,
  `pid` int(11) default NULL,
  `processor` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `user` (`user`),
  KEY `data` (`data`),
  KEY `pid` (`pid`)
);



INSERT INTO `payments` VALUES(4433, 'demo', 1200926818, 43, '127.0.0.1', 'erffeofr35345vdfvfdvd', 'credits', 1, 'paypal');
INSERT INTO `payments` VALUES(7381, '', 1312622635, 84, '127.0.0.1', '53S120574Y267135A', 'order', 85, 'paypal');
INSERT INTO `payments` VALUES(7382, '', 1312622983, 18.5, '127.0.0.1', '5VA13519JY9574415', 'order', 86, 'paypal');
INSERT INTO `payments` VALUES(7383, 'tester', 1320058921, 10, '127.0.0.1', '', 'subscription', 16, 'moneyorder');
INSERT INTO `payments` VALUES(7384, 'tester', 1320059154, 10, '127.0.0.1', '', 'subscription', 18, 'moneyorder');
INSERT INTO `payments` VALUES(7385, 'tester', 1320062812, 8.1, '127.0.0.1', '', 'credits', 63, 'moneyorder');
INSERT INTO `payments` VALUES(7386, 'buyer', 1321959094, 10, '127.0.0.1', '', 'subscription', 21, 'moneyorder');
INSERT INTO `payments` VALUES(7387, 'buyer', 1337343686, 0, '127.0.0.1', 'sdfew', 'credits', 98, 'fortumo');
INSERT INTO `payments` VALUES(7388, 'buyer', 1337343807, 0, '127.0.0.1', 'sdfew', 'credits', 99, 'fortumo');
INSERT INTO `payments` VALUES(7389, 'buyer', 1340866265, 1.15, '127.0.0.1', '', 'credits', 123, 'moneyorder');
INSERT INTO `payments` VALUES(7390, 'buyer', 1340866380, 1, '127.0.0.1', '', 'credits', 124, 'moneyorder');
INSERT INTO `payments` VALUES(7391, 'buyer', 1340866427, 10, '127.0.0.1', '', 'subscription', 24, 'moneyorder');
INSERT INTO `payments` VALUES(7392, 'buyer', 1340866533, 11.5, '127.0.0.1', '', 'subscription', 25, 'moneyorder');
INSERT INTO `payments` VALUES(7393, 'buyer', 1340866818, 1.15, '127.0.0.1', '', 'order', 109, 'moneyorder');
INSERT INTO `payments` VALUES(7394, 'buyer', 1340866900, 1, '127.0.0.1', '', 'order', 110, 'moneyorder');
INSERT INTO `payments` VALUES(7395, 'guest7433', 1348340539, 1, '127.0.0.1', '', 'order', 121, 'moneyorder');
INSERT INTO `payments` VALUES(7396, 'buyer', 1365838033, 1, '127.0.0.1', '', 'credits', 197, 'stripe');
INSERT INTO `payments` VALUES(7397, 'buyer', 1365838197, 1, '127.0.0.1', '', 'credits', 198, 'stripe');
INSERT INTO `payments` VALUES(7398, 'buyer', 1365838297, 1, '127.0.0.1', '', 'credits', 199, 'stripe');
INSERT INTO `payments` VALUES(7399, 'buyer', 1365861812, 1.1, '127.0.0.1', '', 'order', 137, 'moneyorder');
INSERT INTO `payments` VALUES(7400, 'buyer', 1365862003, 1.1, '127.0.0.1', '', 'credits', 200, 'moneyorder');
INSERT INTO `payments` VALUES(7401, 'buyer', 1365862041, 11, '127.0.0.1', '', 'subscription', 27, 'moneyorder');
INSERT INTO `payments` VALUES(7402, 'buyer', 1365932648, 1.1, '127.0.0.1', '', 'credits', 201, 'moneyorder');
INSERT INTO `payments` VALUES(7403, 'buyer', 1365932698, 11, '127.0.0.1', '', 'subscription', 28, 'moneyorder');
INSERT INTO `payments` VALUES(7404, 'buyer', 1365934260, 1.1, '127.0.0.1', '', 'order', 141, 'moneyorder');
INSERT INTO `payments` VALUES(7405, 'guest7440', 1376838035, 1.1, '127.0.0.1', '', 'order', 152, 'moneyorder');



CREATE TABLE `payout` (
  `title` varchar(50) default NULL,
  `activ` int(11) default NULL,
  `svalue` varchar(50) default NULL
);



INSERT INTO `payout` VALUES('Paypal account', 1, 'paypal');
INSERT INTO `payout` VALUES('MoneyBookers account', 1, 'moneybookers');
INSERT INTO `payout` VALUES('Dwolla account', 1, 'dwolla');
INSERT INTO `payout` VALUES('QIWI account', 1, 'qiwi');
INSERT INTO `payout` VALUES('Webmoney account', 1, 'webmoney');
INSERT INTO `payout` VALUES('Bank account', 1, 'bank');



CREATE TABLE `payout_price` (
  `title` varchar(100) default NULL,
  `price` float default NULL
);



INSERT INTO `payout_price` VALUES('1 Credit', 1);



CREATE TABLE `people` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `login` varchar(100) default NULL,
  `password` varchar(100) default NULL,
  `name` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `people` VALUES(1, 0, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Administrator');



CREATE TABLE `people_access` (
  `user` int(11) default NULL,
  `accessdate` int(11) default NULL,
  `ip` varchar(100) default NULL,
  KEY `user` (`user`),
  KEY `accessdate` (`accessdate`)
);


CREATE TABLE `people_rights` (
  `user` int(11) default NULL,
  `user_rights` varchar(50) default NULL,
  KEY `user` (`user`),
  KEY `user_rights` (`user_rights`)
);


INSERT INTO `people_rights` VALUES(1, 'affiliates_settings');
INSERT INTO `people_rights` VALUES(1, 'affiliates_payout');
INSERT INTO `people_rights` VALUES(1, 'affiliates_commission');
INSERT INTO `people_rights` VALUES(1, 'affiliates_stats');
INSERT INTO `people_rights` VALUES(1, 'pages_news');
INSERT INTO `people_rights` VALUES(1, 'pages_textpages');
INSERT INTO `people_rights` VALUES(1, 'templates_home');
INSERT INTO `people_rights` VALUES(1, 'templates_caching');
INSERT INTO `people_rights` VALUES(1, 'templates_templates');
INSERT INTO `people_rights` VALUES(1, 'templates_skins');
INSERT INTO `people_rights` VALUES(1, 'settings_phpini');
INSERT INTO `people_rights` VALUES(1, 'settings_audio');
INSERT INTO `people_rights` VALUES(1, 'settings_ffmpeg');
INSERT INTO `people_rights` VALUES(1, 'settings_video');
INSERT INTO `people_rights` VALUES(1, 'settings_productsoptions');
INSERT INTO `people_rights` VALUES(1, 'settings_previews');
INSERT INTO `people_rights` VALUES(1, 'settings_prints');
INSERT INTO `people_rights` VALUES(1, 'settings_models');
INSERT INTO `people_rights` VALUES(1, 'settings_creditstypes');
INSERT INTO `people_rights` VALUES(1, 'settings_subscription');
INSERT INTO `people_rights` VALUES(1, 'settings_sellercategories');
INSERT INTO `people_rights` VALUES(1, 'settings_content_types');
INSERT INTO `people_rights` VALUES(1, 'settings_networks');
INSERT INTO `people_rights` VALUES(1, 'settings_signup');
INSERT INTO `people_rights` VALUES(1, 'settings_payout');
INSERT INTO `people_rights` VALUES(1, 'settings_couponstypes');
INSERT INTO `people_rights` VALUES(1, 'settings_shipping');
INSERT INTO `people_rights` VALUES(1, 'settings_taxes');
INSERT INTO `people_rights` VALUES(1, 'settings_licenses');
INSERT INTO `people_rights` VALUES(1, 'settings_prices');
INSERT INTO `people_rights` VALUES(1, 'settings_currency');
INSERT INTO `people_rights` VALUES(1, 'settings_payments');
INSERT INTO `people_rights` VALUES(1, 'settings_languages');
INSERT INTO `people_rights` VALUES(1, 'settings_watermark');
INSERT INTO `people_rights` VALUES(1, 'settings_storage');
INSERT INTO `people_rights` VALUES(1, 'settings_site');
INSERT INTO `people_rights` VALUES(1, 'users_blockedip');
INSERT INTO `people_rights` VALUES(1, 'users_password');
INSERT INTO `people_rights` VALUES(1, 'users_administrators');
INSERT INTO `people_rights` VALUES(1, 'users_blogs');
INSERT INTO `people_rights` VALUES(1, 'users_testimonials');
INSERT INTO `people_rights` VALUES(1, 'users_newsletter');
INSERT INTO `people_rights` VALUES(1, 'users_contacts');
INSERT INTO `people_rights` VALUES(1, 'users_messages');
INSERT INTO `people_rights` VALUES(1, 'users_notifications');
INSERT INTO `people_rights` VALUES(1, 'users_customers');
INSERT INTO `people_rights` VALUES(1, 'catalog_lightboxes');
INSERT INTO `people_rights` VALUES(1, 'orders_coupons');
INSERT INTO `people_rights` VALUES(1, 'orders_commission');
INSERT INTO `people_rights` VALUES(1, 'orders_carts');
INSERT INTO `people_rights` VALUES(1, 'catalog_categories');
INSERT INTO `people_rights` VALUES(1, 'catalog_catalog');
INSERT INTO `people_rights` VALUES(1, 'catalog_bulkupload');
INSERT INTO `people_rights` VALUES(1, 'catalog_upload');
INSERT INTO `people_rights` VALUES(1, 'catalog_exam');
INSERT INTO `people_rights` VALUES(1, 'settings_pwinty');
INSERT INTO `people_rights` VALUES(1, 'catalog_comments');
INSERT INTO `people_rights` VALUES(1, 'catalog_search');
INSERT INTO `people_rights` VALUES(1, 'orders_subscription');
INSERT INTO `people_rights` VALUES(1, 'orders_credits');
INSERT INTO `people_rights` VALUES(1, 'orders_orders');



CREATE TABLE `photos` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `data` int(11) default NULL,
  `published` tinyint(1) default NULL,
  `description` text,
  `folder` varchar(50) default NULL,
  `featured` tinyint(1) default NULL,
  `keywords` varchar(250) default NULL,
  `author` varchar(50) default NULL,
  `viewed` int(11) default NULL,
  `userid` int(11) default NULL,
  `watermark` tinyint(1) default NULL,
  `content_type` varchar(50) default NULL,
  `free` tinyint(1) default NULL,
  `orientation` tinyint(1) default NULL,
  `color` varchar(10) default NULL,
  `downloaded` int(11) default NULL,
  `rating` float default NULL,
  `model` int(10) default NULL,
  `server1` int(10) default NULL,
  `server2` int(11) default NULL,
  `server3` int(1) default NULL,
  `examination` tinyint(1) default NULL,
  `category2` int(11) default NULL,
  `category3` int(11) default NULL,
  `google_x` double default NULL,
  `google_y` double default NULL,
  `refuse_reason` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `editorial` tinyint(1) default NULL,
  `adult` tinyint(4) default NULL,
  KEY `data` (`data`),
  KEY `title` (`title`),
  KEY `published` (`published`),
  KEY `viewed` (`viewed`),
  KEY `featured` (`featured`),
  KEY `downloaded` (`downloaded`),
  KEY `free` (`free`),
  KEY `color` (`color`),
  KEY `orientation` (`orientation`),
  KEY `watermark` (`watermark`),
  KEY `userid` (`userid`),
  KEY `author` (`author`),
  KEY `id_parent` (`id_parent`),
  KEY `rating` (`rating`),
  KEY `model` (`model`),
  KEY `examination` (`examination`),
  KEY `category2` (`category2`),
  KEY `category3` (`category3`),
  KEY `google_x` (`google_x`),
  KEY `google_y` (`google_y`),
  KEY `server1` (`server1`),
  KEY `server2` (`server2`),
  KEY `editorial` (`editorial`),
  KEY `adult` (`adult`)
);



INSERT INTO `photos` VALUES(7464, 'Arrogant Cat', 1320587962, 1, 'Viborg', '7464', 1, 'cat', 'siteowner', 124, 0, 5, 'Common', 0, 0, 'blue', 3, NULL, 0, 2, 0, NULL, 0, 7460, 5, 60.7133428316, 28.7309646606, NULL, '/stock-photo/arrogant-cat-7464.html', 1, 0);
INSERT INTO `photos` VALUES(7465, 'Snow Garden', 1320588473, 1, 'Pushkin. Tsarskoye selo', '7465', 0, '', 'siteowner', 111, 0, 5, 'Common', 0, 0, 'blue', 6, NULL, 0, 2, 0, NULL, 0, 5, 5, 59.7132226504, 30.4008865356, NULL, '/stock-photo/snow-garden-7465.html', 0, 0);
INSERT INTO `photos` VALUES(7466, 'Fortress', 1320588580, 1, 'Velikiy Novgorod', '7466', 0, '', 'siteowner', 19, 0, 5, 'Common', 0, 0, 'green', 3, NULL, 0, 2, 0, NULL, 0, 5, 5, 58.5415657276, 31.2856292725, NULL, '/stock-photo/fortress-7466.html', 0, 0);
INSERT INTO `photos` VALUES(7467, 'Mill', 1320588615, 1, 'Velikiy Novgorod. Museum \\&quot;Vitoslavitsy\\&quot;', '7467', 0, '', 'siteowner', 60, 0, 5, 'Common', 0, 0, 'cian', 1, NULL, 0, 2, 0, NULL, 0, 5, 5, 58.4868752799, 31.2770462036, NULL, '/stock-photo/mill-7467.html', 0, 0);
INSERT INTO `photos` VALUES(7468, 'Mew', 1320588639, 1, 'Viborg. Park \\&quot;Mon Repo\\&quot;', '7468', 0, 'mew', 'siteowner', 43, 0, 5, 'Premium', 0, 0, 'cian', 3, NULL, 0, 2, 0, NULL, 0, 7473, 5, 60.7269436111, 28.8061523438, NULL, '/stock-photo/mew-7468.html', 0, 0);
INSERT INTO `photos` VALUES(7469, 'Mews', 1320588698, 1, 'Kizhi. Onega lake', '7469', 0, 'mew', 'siteowner', 18, 0, 5, 'Common', 0, 1, 'blue', 1, NULL, 0, 2, 0, NULL, 0, 7473, 5, 62.3343099292, 34.8486328125, NULL, '/stock-photo/mews-7469.html', 0, 0);
INSERT INTO `photos` VALUES(7470, 'Monastery ', 1320588729, 1, 'Evening glow. Kirillov', '7470', 0, '', 'siteowner', 58, 0, 5, 'Common', 0, 0, 'red', 1, NULL, 0, 2, 0, NULL, 0, 5, 5, 59.8448148597, 38.3752441406, NULL, '/stock-photo/monastery-7470.html', 0, 0);
INSERT INTO `photos` VALUES(7471, 'Sewer manhole', 1320588782, 1, 'Kiev', '7471', 1, '', 'siteowner', 340, 0, 5, 'Common', 0, 0, 'red', 14, NULL, 0, 2, 0, NULL, 0, 7472, 5, 0, 0, NULL, '/stock-photo/sewer-manhole-7471.html', 0, 0);
INSERT INTO `photos` VALUES(7451, 'Venezia 1', 1320586111, 1, 'Ponte di Rialto', '7451', 0, 'bridge,city,venezia', 'siteowner', 28, 0, 5, 'Common', 1, 0, 'magenta', 3, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4380321349, 12.3359942436, NULL, '/stock-photo/venezia-1-7451.html', 0, 0);
INSERT INTO `photos` VALUES(7452, 'Venezia 2', 1320586378, 1, 'Roofs', '7452', 0, 'roofs,venezia', 'siteowner', 6, 0, 5, 'Common', 0, 0, 'yellow', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4345991655, 12.3408651352, NULL, '/stock-photo/venezia-2-7452.html', 0, 0);
INSERT INTO `photos` VALUES(7453, 'Venezia 3', 1320586554, 1, 'Canal Grande. San Giorgio Maggiore', '7453', 0, '', 'siteowner', 2, 0, 5, 'Common', 0, 0, 'cian', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4335451418, 12.3405647278, NULL, '/stock-photo/venezia-3-7453.html', 0, 0);
INSERT INTO `photos` VALUES(7454, 'Venezia 4', 1320586687, 1, 'Galley', '7454', 0, 'canals,venezia', 'siteowner', 3, 0, 5, 'Common', 0, 1, 'blue', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4456802804, 12.3276257515, NULL, '/stock-photo/venezia-4-7454.html', 0, 0);
INSERT INTO `photos` VALUES(7455, 'Venezia 5', 1320586800, 1, 'Court', '7455', 0, 'venezia', 'siteowner', 3, 0, 5, 'Common', 0, 1, 'red', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4341022711, 12.3450493813, NULL, '/stock-photo/venezia-5-7455.html', 0, 0);
INSERT INTO `photos` VALUES(7456, 'Venezia 6', 1320586931, 1, 'Grand canal', '7456', 0, 'venezia,evening glow', 'siteowner', 3, 0, 5, 'Common', 0, 0, 'red', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 45.4336656027, 12.3461008072, NULL, '/stock-photo/venezia-6-7456.html', 0, 0);
INSERT INTO `photos` VALUES(7457, 'Firenze 1', 1320587290, 1, 'La Cattedrale di Santa Maria del Fiore', '7457', 0, 'firenze', 'siteowner', 15, 0, 5, 'Common', 0, 1, 'yellow', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 43.7727827255, 11.2555575371, NULL, '/stock-photo/firenze-1-7457.html', 0, 0);
INSERT INTO `photos` VALUES(7458, 'Firenze 2', 1320587417, 1, 'Evening glow. Ponte Vecchio', '7458', 1, 'firenze,bridge', 'siteowner', 21, 0, 5, 'Common', 0, 0, 'red', 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 43.7700711532, 11.247253418, NULL, '/stock-photo/firenze-2-7458.html', 0, 0);
INSERT INTO `photos` VALUES(7459, 'Firenze 3', 1320587482, 1, 'Ponte Vecchio', '7459', 0, 'firenze,bridge', 'siteowner', 7, 0, 5, 'Common', 1, 0, 'yellow', 3, NULL, 0, 2, 0, NULL, 0, 5, 5, 43.7701486284, 11.2457513809, NULL, '/stock-photo/firenze-3-7459.html', 0, 0);
INSERT INTO `photos` VALUES(7461, 'Small Cat', 1320587830, 1, 'Saint-Petersburg', '7461', 1, 'cat,animal', 'siteowner', 20, 0, 5, 'Common', 0, 0, 'green', 1, NULL, 0, 2, 0, NULL, 0, 5, 5, 59.916418919, 30.3524780273, NULL, '/stock-photo/small-cat-7461.html', 1, 0);
INSERT INTO `photos` VALUES(7462, 'Thin Cat', 1320587873, 1, 'Roma. Piazza Argentina', '7462', 0, 'cat,animal', 'siteowner', 2, 0, 5, 'Common', 1, 1, 'red', 0, NULL, 0, 2, 0, NULL, 0, 7460, 5, 41.896655134, 12.4740314484, NULL, '/stock-photo/thin-cat-7462.html', 0, 0);
INSERT INTO `photos` VALUES(7463, 'Cat', 1320587930, 1, 'Roma. Piazza Argentina', '7463', 0, 'cat', 'siteowner', 7, 0, 5, 'Common', 0, 0, 'red', 0, NULL, 0, 2, 0, NULL, 0, 7460, 5, 41.896655134, 12.4740314484, NULL, '/stock-photo/cat-7463.html', 0, 0);



CREATE TABLE `prints` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `description` text,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `weight` float default NULL,
  `option1` int(11) default NULL,
  `option2` int(11) default NULL,
  `option3` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`)
);



INSERT INTO `prints` VALUES(4125, 'Print 4x6', '', 1, 3, 0.001, 1, 6, 0);
INSERT INTO `prints` VALUES(4126, 'Print 5x7', '', 2, 4, 0.002, 1, 6, 0);
INSERT INTO `prints` VALUES(4127, 'Print 8x10', '', 3, 5, 0.003, 1, 6, 0);
INSERT INTO `prints` VALUES(4128, 'Print 11x14', '', 4, 6, 0.004, 1, 6, 0);
INSERT INTO `prints` VALUES(4133, 'Mug', '', 11, 7, 0.2, 4, 0, 0);
INSERT INTO `prints` VALUES(4134, 'T-shirt', '', 10, 8, 0.2, 3, 2, 0);



CREATE TABLE `prints_items` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `price` float default NULL,
  `itemid` int(11) default NULL,
  `priority` int(11) default NULL,
  `printsid` int(11) default NULL,
  PRIMARY KEY  (`id_parent`),
  UNIQUE KEY `id_parent_2` (`id_parent`),
  KEY `id_parent` (`id_parent`),
  KEY `itemid` (`itemid`),
  KEY `priority` (`priority`),
  KEY `printsid` (`printsid`)
);



INSERT INTO `prints_items` VALUES(8952, 'Glossy 5x7', 4, 7673, 6, 4128);
INSERT INTO `prints_items` VALUES(8951, 'Matte 5x7', 3, 7673, 5, 4127);
INSERT INTO `prints_items` VALUES(8950, 'Glossy 8x10', 2, 7673, 4, 4126);
INSERT INTO `prints_items` VALUES(8949, 'Matte 8x10', 1, 7673, 3, 4125);
INSERT INTO `prints_items` VALUES(8622, 'Glossy 5x7', 4, 7587, 6, 4128);
INSERT INTO `prints_items` VALUES(8625, 'Matte 8x10', 1, 7588, 3, 4125);
INSERT INTO `prints_items` VALUES(8626, 'Glossy 8x10', 2, 7588, 4, 4126);
INSERT INTO `prints_items` VALUES(8627, 'Matte 5x7', 3, 7588, 5, 4127);
INSERT INTO `prints_items` VALUES(8628, 'Glossy 5x7', 4, 7588, 6, 4128);
INSERT INTO `prints_items` VALUES(8621, 'Matte 5x7', 3, 7587, 5, 4127);
INSERT INTO `prints_items` VALUES(8620, 'Glossy 8x10', 2, 7587, 4, 4126);
INSERT INTO `prints_items` VALUES(8619, 'Matte 8x10', 1, 7587, 3, 4125);
INSERT INTO `prints_items` VALUES(8166, 'Print 11x14', 4, 7466, 6, 4128);
INSERT INTO `prints_items` VALUES(8169, 'Print 4x6', 1, 7467, 3, 4125);
INSERT INTO `prints_items` VALUES(8170, 'Print 5x7', 2, 7467, 4, 4126);
INSERT INTO `prints_items` VALUES(8171, 'Print 8x10', 3, 7467, 5, 4127);
INSERT INTO `prints_items` VALUES(8172, 'Print 11x14', 4, 7467, 6, 4128);
INSERT INTO `prints_items` VALUES(8175, 'Print 4x6', 1, 7468, 3, 4125);
INSERT INTO `prints_items` VALUES(8176, 'Print 5x7', 2, 7468, 4, 4126);
INSERT INTO `prints_items` VALUES(8177, 'Print 8x10', 3, 7468, 5, 4127);
INSERT INTO `prints_items` VALUES(8178, 'Print 11x14', 4, 7468, 6, 4128);
INSERT INTO `prints_items` VALUES(8181, 'Print 4x6', 1, 7469, 3, 4125);
INSERT INTO `prints_items` VALUES(8182, 'Print 5x7', 2, 7469, 4, 4126);
INSERT INTO `prints_items` VALUES(8183, 'Print 8x10', 3, 7469, 5, 4127);
INSERT INTO `prints_items` VALUES(8184, 'Print 11x14', 4, 7469, 6, 4128);
INSERT INTO `prints_items` VALUES(8187, 'Print 4x6', 1, 7470, 3, 4125);
INSERT INTO `prints_items` VALUES(8188, 'Print 5x7', 2, 7470, 4, 4126);
INSERT INTO `prints_items` VALUES(8189, 'Print 8x10', 3, 7470, 5, 4127);
INSERT INTO `prints_items` VALUES(8190, 'Print 11x14', 4, 7470, 6, 4128);
INSERT INTO `prints_items` VALUES(8193, 'Print 4x6', 1, 7471, 3, 4125);
INSERT INTO `prints_items` VALUES(8194, 'Print 5x7', 2, 7471, 4, 4126);
INSERT INTO `prints_items` VALUES(8195, 'Print 8x10', 3, 7471, 5, 4127);
INSERT INTO `prints_items` VALUES(8196, 'Print 11x14', 4, 7471, 6, 4128);
INSERT INTO `prints_items` VALUES(8940, 'Glossy 5x7', 4, 7671, 6, 4128);
INSERT INTO `prints_items` VALUES(8939, 'Matte 5x7', 3, 7671, 5, 4127);
INSERT INTO `prints_items` VALUES(8938, 'Glossy 8x10', 2, 7671, 4, 4126);
INSERT INTO `prints_items` VALUES(8937, 'Matte 8x10', 1, 7671, 3, 4125);
INSERT INTO `prints_items` VALUES(8934, 'Glossy 5x7', 4, 7670, 6, 4128);
INSERT INTO `prints_items` VALUES(8634, 'Glossy 5x7', 4, 7589, 6, 4128);
INSERT INTO `prints_items` VALUES(8633, 'Matte 5x7', 3, 7589, 5, 4127);
INSERT INTO `prints_items` VALUES(8632, 'Glossy 8x10', 2, 7589, 4, 4126);
INSERT INTO `prints_items` VALUES(8631, 'Matte 8x10', 1, 7589, 3, 4125);
INSERT INTO `prints_items` VALUES(8165, 'Print 8x10', 3, 7466, 5, 4127);
INSERT INTO `prints_items` VALUES(8164, 'Print 5x7', 2, 7466, 4, 4126);
INSERT INTO `prints_items` VALUES(8163, 'Print 4x6', 1, 7466, 3, 4125);
INSERT INTO `prints_items` VALUES(8079, 'Print 4x6', 1, 7451, 3, 4125);
INSERT INTO `prints_items` VALUES(8080, 'Print 5x7', 2, 7451, 4, 4126);
INSERT INTO `prints_items` VALUES(8081, 'Print 8x10', 3, 7451, 5, 4127);
INSERT INTO `prints_items` VALUES(8082, 'Print 11x14', 4, 7451, 6, 4128);
INSERT INTO `prints_items` VALUES(8085, 'Print 4x6', 1, 7452, 3, 4125);
INSERT INTO `prints_items` VALUES(8086, 'Print 5x7', 2, 7452, 4, 4126);
INSERT INTO `prints_items` VALUES(8087, 'Print 8x10', 3, 7452, 5, 4127);
INSERT INTO `prints_items` VALUES(8088, 'Print 11x14', 4, 7452, 6, 4128);
INSERT INTO `prints_items` VALUES(8091, 'Print 4x6', 1, 7453, 3, 4125);
INSERT INTO `prints_items` VALUES(8092, 'Print 5x7', 2, 7453, 4, 4126);
INSERT INTO `prints_items` VALUES(8093, 'Print 8x10', 3, 7453, 5, 4127);
INSERT INTO `prints_items` VALUES(8094, 'Print 11x14', 4, 7453, 6, 4128);
INSERT INTO `prints_items` VALUES(8097, 'Print 4x6', 1, 7454, 3, 4125);
INSERT INTO `prints_items` VALUES(8098, 'Print 5x7', 2, 7454, 4, 4126);
INSERT INTO `prints_items` VALUES(8099, 'Print 8x10', 3, 7454, 5, 4127);
INSERT INTO `prints_items` VALUES(8100, 'Print 11x14', 4, 7454, 6, 4128);
INSERT INTO `prints_items` VALUES(8103, 'Print 4x6', 1, 7455, 3, 4125);
INSERT INTO `prints_items` VALUES(8104, 'Print 5x7', 2, 7455, 4, 4126);
INSERT INTO `prints_items` VALUES(8105, 'Print 8x10', 3, 7455, 5, 4127);
INSERT INTO `prints_items` VALUES(8106, 'Print 11x14', 4, 7455, 6, 4128);
INSERT INTO `prints_items` VALUES(8109, 'Print 4x6', 1, 7456, 3, 4125);
INSERT INTO `prints_items` VALUES(8110, 'Print 5x7', 2, 7456, 4, 4126);
INSERT INTO `prints_items` VALUES(8111, 'Print 8x10', 3, 7456, 5, 4127);
INSERT INTO `prints_items` VALUES(8112, 'Print 11x14', 4, 7456, 6, 4128);
INSERT INTO `prints_items` VALUES(8115, 'Print 4x6', 1, 7457, 3, 4125);
INSERT INTO `prints_items` VALUES(8116, 'Print 5x7', 2, 7457, 4, 4126);
INSERT INTO `prints_items` VALUES(8117, 'Print 8x10', 3, 7457, 5, 4127);
INSERT INTO `prints_items` VALUES(8118, 'Print 11x14', 4, 7457, 6, 4128);
INSERT INTO `prints_items` VALUES(8121, 'Print 4x6', 1, 7458, 3, 4125);
INSERT INTO `prints_items` VALUES(8122, 'Print 5x7', 2, 7458, 4, 4126);
INSERT INTO `prints_items` VALUES(8123, 'Print 8x10', 3, 7458, 5, 4127);
INSERT INTO `prints_items` VALUES(8124, 'Print 11x14', 4, 7458, 6, 4128);
INSERT INTO `prints_items` VALUES(8127, 'Print 4x6', 1, 7459, 3, 4125);
INSERT INTO `prints_items` VALUES(8128, 'Print 5x7', 2, 7459, 4, 4126);
INSERT INTO `prints_items` VALUES(8129, 'Print 8x10', 3, 7459, 5, 4127);
INSERT INTO `prints_items` VALUES(8130, 'Print 11x14', 4, 7459, 6, 4128);
INSERT INTO `prints_items` VALUES(8133, 'Print 4x6', 1, 7461, 3, 4125);
INSERT INTO `prints_items` VALUES(8134, 'Print 5x7', 2, 7461, 4, 4126);
INSERT INTO `prints_items` VALUES(8135, 'Print 8x10', 3, 7461, 5, 4127);
INSERT INTO `prints_items` VALUES(8136, 'Print 11x14', 4, 7461, 6, 4128);
INSERT INTO `prints_items` VALUES(8139, 'Print 4x6', 1, 7462, 3, 4125);
INSERT INTO `prints_items` VALUES(8140, 'Print 5x7', 2, 7462, 4, 4126);
INSERT INTO `prints_items` VALUES(8141, 'Print 8x10', 3, 7462, 5, 4127);
INSERT INTO `prints_items` VALUES(8142, 'Print 11x14', 4, 7462, 6, 4128);
INSERT INTO `prints_items` VALUES(8145, 'Print 4x6', 1, 7463, 3, 4125);
INSERT INTO `prints_items` VALUES(8146, 'Print 5x7', 2, 7463, 4, 4126);
INSERT INTO `prints_items` VALUES(8147, 'Print 8x10', 3, 7463, 5, 4127);
INSERT INTO `prints_items` VALUES(8148, 'Print 11x14', 4, 7463, 6, 4128);
INSERT INTO `prints_items` VALUES(8151, 'Print 4x6', 1, 7464, 3, 4125);
INSERT INTO `prints_items` VALUES(8152, 'Print 5x7', 2, 7464, 4, 4126);
INSERT INTO `prints_items` VALUES(8153, 'Print 8x10', 3, 7464, 5, 4127);
INSERT INTO `prints_items` VALUES(8154, 'Print 11x14', 4, 7464, 6, 4128);
INSERT INTO `prints_items` VALUES(8157, 'Print 4x6', 1, 7465, 3, 4125);
INSERT INTO `prints_items` VALUES(8158, 'Print 5x7', 2, 7465, 4, 4126);
INSERT INTO `prints_items` VALUES(8159, 'Print 8x10', 3, 7465, 5, 4127);
INSERT INTO `prints_items` VALUES(8160, 'Print 11x14', 4, 7465, 6, 4128);
INSERT INTO `prints_items` VALUES(7383, 'Matte 8x10', 1, 4839, 3, 4125);
INSERT INTO `prints_items` VALUES(7384, 'Glossy 8x10', 2, 4839, 4, 4126);
INSERT INTO `prints_items` VALUES(7385, 'Matte 5x7', 3, 4839, 5, 4127);
INSERT INTO `prints_items` VALUES(7386, 'Glossy 5x7', 4, 4839, 6, 4128);
INSERT INTO `prints_items` VALUES(7389, 'Matte 8x10', 1, 7011, 3, 4125);
INSERT INTO `prints_items` VALUES(7390, 'Glossy 8x10', 2, 7011, 4, 4126);
INSERT INTO `prints_items` VALUES(7391, 'Matte 5x7', 3, 7011, 5, 4127);
INSERT INTO `prints_items` VALUES(7392, 'Glossy 5x7', 4, 7011, 6, 4128);
INSERT INTO `prints_items` VALUES(8946, 'Glossy 5x7', 4, 7672, 6, 4128);
INSERT INTO `prints_items` VALUES(8945, 'Matte 5x7', 3, 7672, 5, 4127);
INSERT INTO `prints_items` VALUES(8944, 'Glossy 8x10', 2, 7672, 4, 4126);
INSERT INTO `prints_items` VALUES(8943, 'Matte 8x10', 1, 7672, 3, 4125);
INSERT INTO `prints_items` VALUES(8933, 'Matte 5x7', 3, 7670, 5, 4127);
INSERT INTO `prints_items` VALUES(8932, 'Glossy 8x10', 2, 7670, 4, 4126);
INSERT INTO `prints_items` VALUES(8931, 'Matte 8x10', 1, 7670, 3, 4125);
INSERT INTO `prints_items` VALUES(8733, 'Matte 8x10', 1, 7176, 3, 4125);
INSERT INTO `prints_items` VALUES(8734, 'Glossy 8x10', 2, 7176, 4, 4126);
INSERT INTO `prints_items` VALUES(8735, 'Matte 5x7', 3, 7176, 5, 4127);
INSERT INTO `prints_items` VALUES(8736, 'Glossy 5x7', 4, 7176, 6, 4128);
INSERT INTO `prints_items` VALUES(9074, 'T-shirt', 10, 7451, 8, 4134);
INSERT INTO `prints_items` VALUES(9073, 'Mug', 11, 7451, 7, 4133);
INSERT INTO `prints_items` VALUES(9075, 'Mug', 11, 7452, 7, 4133);
INSERT INTO `prints_items` VALUES(9076, 'T-shirt', 10, 7452, 8, 4134);
INSERT INTO `prints_items` VALUES(9077, 'Mug', 11, 7453, 7, 4133);
INSERT INTO `prints_items` VALUES(9078, 'T-shirt', 10, 7453, 8, 4134);
INSERT INTO `prints_items` VALUES(9079, 'Mug', 11, 7454, 7, 4133);
INSERT INTO `prints_items` VALUES(9080, 'T-shirt', 10, 7454, 8, 4134);
INSERT INTO `prints_items` VALUES(9081, 'Mug', 11, 7455, 7, 4133);
INSERT INTO `prints_items` VALUES(9082, 'T-shirt', 10, 7455, 8, 4134);
INSERT INTO `prints_items` VALUES(9083, 'Mug', 11, 7456, 7, 4133);
INSERT INTO `prints_items` VALUES(9084, 'T-shirt', 10, 7456, 8, 4134);
INSERT INTO `prints_items` VALUES(9085, 'Mug', 11, 7457, 7, 4133);
INSERT INTO `prints_items` VALUES(9086, 'T-shirt', 10, 7457, 8, 4134);
INSERT INTO `prints_items` VALUES(9087, 'Mug', 11, 7458, 7, 4133);
INSERT INTO `prints_items` VALUES(9088, 'T-shirt', 10, 7458, 8, 4134);
INSERT INTO `prints_items` VALUES(9089, 'Mug', 11, 7459, 7, 4133);
INSERT INTO `prints_items` VALUES(9090, 'T-shirt', 10, 7459, 8, 4134);
INSERT INTO `prints_items` VALUES(9091, 'Mug', 11, 7461, 7, 4133);
INSERT INTO `prints_items` VALUES(9092, 'T-shirt', 10, 7461, 8, 4134);
INSERT INTO `prints_items` VALUES(9093, 'Mug', 11, 7462, 7, 4133);
INSERT INTO `prints_items` VALUES(9094, 'T-shirt', 10, 7462, 8, 4134);
INSERT INTO `prints_items` VALUES(9095, 'Mug', 11, 7463, 7, 4133);
INSERT INTO `prints_items` VALUES(9096, 'T-shirt', 10, 7463, 8, 4134);
INSERT INTO `prints_items` VALUES(9097, 'Mug', 11, 7464, 7, 4133);
INSERT INTO `prints_items` VALUES(9098, 'T-shirt', 10, 7464, 8, 4134);
INSERT INTO `prints_items` VALUES(9099, 'Mug', 11, 7465, 7, 4133);
INSERT INTO `prints_items` VALUES(9100, 'T-shirt', 10, 7465, 8, 4134);
INSERT INTO `prints_items` VALUES(9101, 'Mug', 11, 7466, 7, 4133);
INSERT INTO `prints_items` VALUES(9102, 'T-shirt', 10, 7466, 8, 4134);
INSERT INTO `prints_items` VALUES(9103, 'Mug', 11, 7467, 7, 4133);
INSERT INTO `prints_items` VALUES(9104, 'T-shirt', 10, 7467, 8, 4134);
INSERT INTO `prints_items` VALUES(9105, 'Mug', 11, 7468, 7, 4133);
INSERT INTO `prints_items` VALUES(9106, 'T-shirt', 10, 7468, 8, 4134);
INSERT INTO `prints_items` VALUES(9107, 'Mug', 11, 7469, 7, 4133);
INSERT INTO `prints_items` VALUES(9108, 'T-shirt', 10, 7469, 8, 4134);
INSERT INTO `prints_items` VALUES(9109, 'Mug', 11, 7470, 7, 4133);
INSERT INTO `prints_items` VALUES(9110, 'T-shirt', 10, 7470, 8, 4134);
INSERT INTO `prints_items` VALUES(9111, 'Mug', 11, 7471, 7, 4133);
INSERT INTO `prints_items` VALUES(9112, 'T-shirt', 10, 7471, 8, 4134);



CREATE TABLE `products_options` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `type` varchar(100) default NULL,
  `activ` tinyint(4) default NULL,
  `required` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  KEY `activ` (`activ`)
);


INSERT INTO `products_options` VALUES(1, 'Paper type', '_select_form', 1, 1);
INSERT INTO `products_options` VALUES(2, 'Size of t-shirts', '_select_form', 1, 1);
INSERT INTO `products_options` VALUES(3, 'Color of t-shirts', '_select_form', 1, 1);
INSERT INTO `products_options` VALUES(4, 'Color of mugs', '_select_form', 1, 1);
INSERT INTO `products_options` VALUES(6, 'Framed', 'radio', 1, 1);



CREATE TABLE `products_options_items` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `title` varchar(100) default NULL,
  `price` float default NULL,
  `adjust` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`)
);



INSERT INTO `products_options_items` VALUES(53, 1, 'Glossy', 1, 1);
INSERT INTO `products_options_items` VALUES(52, 1, 'Matte', 0, 1);
INSERT INTO `products_options_items` VALUES(30, 2, 'XXL', 0, 1);
INSERT INTO `products_options_items` VALUES(29, 2, 'XL', 0, 1);
INSERT INTO `products_options_items` VALUES(28, 2, 'L', 0, 1);
INSERT INTO `products_options_items` VALUES(27, 2, 'M', 0, 1);
INSERT INTO `products_options_items` VALUES(26, 2, 'S', 0, 1);
INSERT INTO `products_options_items` VALUES(25, 2, 'XS', 0, 1);
INSERT INTO `products_options_items` VALUES(35, 3, 'Red', 0, 1);
INSERT INTO `products_options_items` VALUES(34, 3, 'Green', 0, 1);
INSERT INTO `products_options_items` VALUES(33, 3, 'Black', 0, 1);
INSERT INTO `products_options_items` VALUES(32, 3, 'White', 0, 1);
INSERT INTO `products_options_items` VALUES(31, 2, 'XXXL', 0, 1);
INSERT INTO `products_options_items` VALUES(47, 4, 'Red', 0, 1);
INSERT INTO `products_options_items` VALUES(46, 4, 'Black', 0, 1);
INSERT INTO `products_options_items` VALUES(51, 6, 'No', 0, 1);
INSERT INTO `products_options_items` VALUES(50, 6, 'Yes', 0, 1);



CREATE TABLE `pwinty` (
  `account` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `testmode` tinyint(4) default NULL,
  `order_number` int(11) default NULL
);



INSERT INTO `pwinty` VALUES('test', 'test', 1, 120);



CREATE TABLE `pwinty_orders` (
  `order_id` int(11) default NULL,
  `pwinty_id` int(11) default NULL,
  `data` int(11) default NULL,
  KEY `order_id` (`order_id`)
);



CREATE TABLE `pwinty_prints` (
  `print_id` int(11) default NULL,
  `activ` tinyint(4) default NULL,
  `title` varchar(100) default NULL,
  KEY `print_id` (`print_id`),
  KEY `activ` (`activ`)
);



INSERT INTO `pwinty_prints` VALUES(4125, 1, '4x6');
INSERT INTO `pwinty_prints` VALUES(4126, 1, '5x7');
INSERT INTO `pwinty_prints` VALUES(4127, 1, '8x10');
INSERT INTO `pwinty_prints` VALUES(4128, 1, '11x14');
INSERT INTO `pwinty_prints` VALUES(4133, 0, '');
INSERT INTO `pwinty_prints` VALUES(4134, 0, '');



CREATE TABLE `reviews` (
  `id_parent` int(11) NOT NULL auto_increment,
  `fromuser` varchar(200) default NULL,
  `content` text,
  `itemid` int(11) default NULL,
  `data` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `fromuser` (`fromuser`),
  KEY `itemid` (`itemid`),
  KEY `data` (`data`)
);



INSERT INTO `reviews` VALUES(7521, 'demo', 'Class!!', 7176, 1349688395);
INSERT INTO `reviews` VALUES(7520, 'buyer', 'Excellent!', 4817, 1337256503);
INSERT INTO `reviews` VALUES(7522, 'demo', 'Wow!', 7471, 1349712692);



CREATE TABLE `search_history` (
  `zapros` varchar(250) default NULL,
  `data` int(11) default NULL,
  KEY `zapros` (`zapros`),
  KEY `data` (`data`)
);


INSERT INTO `search_history` VALUES('cat', 1374222608);
INSERT INTO `search_history` VALUES('cat', 1375947570);
INSERT INTO `search_history` VALUES('nature', 1375954857);
INSERT INTO `search_history` VALUES('cat', 1376035980);
INSERT INTO `search_history` VALUES('bird', 1376035984);
INSERT INTO `search_history` VALUES('cat', 1376644050);
INSERT INTO `search_history` VALUES('arrogant', 1376644058);



CREATE TABLE `settings` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `svalue` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `setting_key` varchar(250) default NULL,
  `priority` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `settings` VALUES(1, 'Site name', 'Photo Video Store', 0, 'site_name', 10);
INSERT INTO `settings` VALUES(2, 'Admin email', 'sales@cmsaccount.com', 0, 'admin_email', 20);
INSERT INTO `settings` VALUES(5, 'Small thumb width', '120', 0, 'thumb_width', 85);
INSERT INTO `settings` VALUES(6, 'Big thumb width', '400', 0, 'thumb_width2', 95);
INSERT INTO `settings` VALUES(7, 'Lightbox photo', '', 1, 'lightbox_photo', 130);
INSERT INTO `settings` VALUES(8, 'Lightbox video', '', 1, 'lightbox_video', 140);
INSERT INTO `settings` VALUES(11, 'Date format', 'm/d/Y', 0, 'date_format', 40);
INSERT INTO `settings` VALUES(12, 'Items on the page', '10', 0, 'k_str', 80);
INSERT INTO `settings` VALUES(23, 'photographers', '', 1, 'userupload', 73);
INSERT INTO `settings` VALUES(15, 'Items in the row', '5', 0, 'k_row', 80);
INSERT INTO `settings` VALUES(16, 'Lightbox video width', '300', 0, 'video_width', 140);
INSERT INTO `settings` VALUES(17, 'Lightbox video height', '225', 0, 'video_height', 150);
INSERT INTO `settings` VALUES(18, 'Left column width', '190', 0, 'left_width', 160);
INSERT INTO `settings` VALUES(19, 'Right column width', '1', 0, 'right_width', 170);
INSERT INTO `settings` VALUES(20, 'Items in news box', '2', 0, 'qnews', 190);
INSERT INTO `settings` VALUES(21, 'Items in best seller box', '1', 0, 'qbest', 200);
INSERT INTO `settings` VALUES(22, 'From', 'noreply@cmsaccount.com', 0, 'from_email', 30);
INSERT INTO `settings` VALUES(24, 'allow photo types', 'jpg,jpeg,gif,png', 0, 'uploadphoto', 220);
INSERT INTO `settings` VALUES(25, 'allow video types', 'wmv,flv,avi,mod', 0, 'uploadvideo', 230);
INSERT INTO `settings` VALUES(26, 'user status as default', 'Silver', 0, 'userstatus', 240);
INSERT INTO `settings` VALUES(47, 'Allow audio types', 'mp3,wav', 0, 'uploadaudio', 235);
INSERT INTO `settings` VALUES(28, 'Upload video limit (Mb)', '250', 0, 'videolimit', 260);
INSERT INTO `settings` VALUES(29, 'Upload preview video limit', '10', 0, 'previewvideolimit', 270);
INSERT INTO `settings` VALUES(30, 'Upload photo limit (Mb)', '3', 0, 'photolimit', 255);
INSERT INTO `settings` VALUES(31, 'Avatar width', '25', 0, 'avatarwidth', 290);
INSERT INTO `settings` VALUES(32, 'User photo width', '140', 0, 'userphotowidth', 300);
INSERT INTO `settings` VALUES(33, 'Photo preupload folder', '/content/photopreupload/', 0, 'photopreupload', 310);
INSERT INTO `settings` VALUES(34, 'Video preupload folder', '/content/videopreupload/', 0, 'videopreupload', 320);
INSERT INTO `settings` VALUES(35, 'Audio preupload folder', '/content/audiopreupload/', 0, 'audiopreupload', 330);
INSERT INTO `settings` VALUES(36, 'small thumb height', '120', 0, 'thumb_height', 90);
INSERT INTO `settings` VALUES(37, 'big thumb height', '400', 0, 'thumb_height2', 100);
INSERT INTO `settings` VALUES(38, 'Allow photo', '', 1, 'allow_photo', 50);
INSERT INTO `settings` VALUES(39, 'Allow video', '', 1, 'allow_video', 53);
INSERT INTO `settings` VALUES(40, 'Allow audio', '', 1, 'allow_audio', 55);
INSERT INTO `settings` VALUES(41, 'Blog', '', 1, 'blog', 340);
INSERT INTO `settings` VALUES(42, 'Messages', '', 1, 'messages', 350);
INSERT INTO `settings` VALUES(43, 'Testimonials', '', 1, 'testimonials', 360);
INSERT INTO `settings` VALUES(44, 'Reviews', '', 1, 'reviews', 370);
INSERT INTO `settings` VALUES(45, 'Friends', '', 1, 'friends', 380);
INSERT INTO `settings` VALUES(46, 'prints', '', 1, 'prints', 64);
INSERT INTO `settings` VALUES(48, 'Upload audio limit (Mb)', '20', 0, 'audiolimit', 275);
INSERT INTO `settings` VALUES(49, 'Upload preview audio limit', '5', 0, 'previewaudiolimit', 276);
INSERT INTO `settings` VALUES(53, 'sell prints only', '', 0, 'printsonly', 66);
INSERT INTO `settings` VALUES(54, 'show watermark info', '', 1, 'watermarkinfo', 410);
INSERT INTO `settings` VALUES(55, 'Allow vector types', 'cdr,ai,eps,zip', 0, 'uploadvector', 237);
INSERT INTO `settings` VALUES(56, 'allow vector', '', 1, 'allow_vector', 60);
INSERT INTO `settings` VALUES(58, 'vector preupload folder', '/content/vectorpreupload/', 0, 'vectorpreupload', 335);
INSERT INTO `settings` VALUES(59, 'credits', '', 1, 'credits', 78);
INSERT INTO `settings` VALUES(60, 'download limit', '5', 0, 'download_limit', 430);
INSERT INTO `settings` VALUES(61, 'days till download expiration', '15', 0, 'download_expiration', 440);
INSERT INTO `settings` VALUES(63, 'Upload vector limit (Mb)', '20', 0, 'vectorlimit', 277);
INSERT INTO `settings` VALUES(64, 'Download sample', '', 1, 'download_sample', 450);
INSERT INTO `settings` VALUES(65, 'Check or Money Order', '', 1, 'moneyorder', 460);
INSERT INTO `settings` VALUES(66, 'Subscription', '', 1, 'subscription', 79);
INSERT INTO `settings` VALUES(67, 'Related items', '', 1, 'related_items', 480);
INSERT INTO `settings` VALUES(68, 'Content type as default', 'Common', 0, 'content_type', 242);
INSERT INTO `settings` VALUES(69, 'Related items quantity', '10', 0, 'related_items_quantity', 485);
INSERT INTO `settings` VALUES(70, 'Zoomer', '', 1, 'zoomer', 490);
INSERT INTO `settings` VALUES(71, 'user uploads premoderation', '', 1, 'moderation', 77);
INSERT INTO `settings` VALUES(72, 'prints for users', '', 1, 'prints_users', 65);
INSERT INTO `settings` VALUES(73, 'model property release', '', 1, 'model', 510);
INSERT INTO `settings` VALUES(74, 'Flash', '', 1, 'flash', 520);
INSERT INTO `settings` VALUES(75, 'Flash width', '400', 0, 'flash_width', 530);
INSERT INTO `settings` VALUES(76, 'Flash height', '290', 0, 'flash_height', 540);
INSERT INTO `settings` VALUES(77, 'Seller examination', '', 1, 'examination', 77);
INSERT INTO `settings` VALUES(78, 'Items in Bulk Upload', '10', 0, 'bulk_upload', 580);
INSERT INTO `settings` VALUES(79, 'show model property release', '', 0, 'show_model', 515);
INSERT INTO `settings` VALUES(80, 'Google Coordinates', '', 1, 'google_coordinates', 585);
INSERT INTO `settings` VALUES(81, 'Google map <a href=http://code.google.com/intl/en/apis/maps/signup.html target=blank>API</a>', '', 0, 'google_api', 590);
INSERT INTO `settings` VALUES(82, 'Show EXIF info', '', 1, 'exif', 595);
INSERT INTO `settings` VALUES(83, 'affiliates', '', 1, 'affiliates', 74);
INSERT INTO `settings` VALUES(84, 'Subscription only', '', 0, 'subscription_only', 79);
INSERT INTO `settings` VALUES(90, 'Meta keywords', 'photo store, video stock, php script', 0, 'meta_keywords', 15);
INSERT INTO `settings` VALUES(85, 'Common account for buyers,sellers and affiliates', '', 1, 'common_account', 77);
INSERT INTO `settings` VALUES(89, 'Login as guest', '', 1, 'site_guest', 77);
INSERT INTO `settings` VALUES(86, 'Google <a href=https://www.google.com/recaptcha/admin/create target=blank>Captcha', '', 0, 'google_captcha', 600);
INSERT INTO `settings` VALUES(87, 'Google Captcha Public Key', '6LcGbMoSAAAAAIStXBGMnRYldIefVK54EiIrCubq', 0, 'google_captcha_public', 605);
INSERT INTO `settings` VALUES(88, 'Google Captcha Private Key', '6LcGbMoSAAAAAHTLpzNeDfOzmo-YKZeIAvJwwx1w', 0, 'google_captcha_private', 610);
INSERT INTO `settings` VALUES(91, 'Meta description', 'Photo Video Store script allows you to sell photos online', 0, 'meta_description', 16);
INSERT INTO `settings` VALUES(92, 'Java Photo Uploader', '', 1, 'java_uploader', 620);
INSERT INTO `settings` VALUES(93, 'Flash Photo Uploader', '', 0, 'flash_uploader', 630);
INSERT INTO `settings` VALUES(94, 'Address', 'Your company name\r\n15 Noname St., 250\r\nLos Angeles 90210, USA\r\nTelephone: 1-675-234-56-78', 0, 'company_address', 17);
INSERT INTO `settings` VALUES(95, 'Show users as', 'name', 0, 'show_users_type', 244);
INSERT INTO `settings` VALUES(96, 'Sorting of catalog', 'date', 0, 'sorting_catalog', 81);
INSERT INTO `settings` VALUES(97, 'Simple Photo Uploader', '', 1, 'jquery_uploader', 631);
INSERT INTO `settings` VALUES(98, 'Seller may set prices', '', 1, 'seller_prices', 640);
INSERT INTO `settings` VALUES(99, 'Automatic language detection', '', 1, 'language_detection', 650);
INSERT INTO `settings` VALUES(100, 'Photo resolution in DPI', '300', 0, 'resolution_dpi', 83);
INSERT INTO `settings` VALUES(101, 'Telephone', '1-234-765-4967', 0, 'telephone', 18);
INSERT INTO `settings` VALUES(102, 'Adult content', '', 1, 'adult_content', 82);
INSERT INTO `settings` VALUES(103, 'Category preview', '200', 0, 'category_preview', 110);
INSERT INTO `settings` VALUES(104, 'Weight', 'lbs', 0, 'weight', 660);
INSERT INTO `settings` VALUES(114, 'auto paging by default', '', 1, 'auto_paging_default', 178);
INSERT INTO `settings` VALUES(112, 'flow by default', '', 1, 'flow_default', 176);
INSERT INTO `settings` VALUES(113, 'auto paging', '', 1, 'auto_paging', 177);
INSERT INTO `settings` VALUES(108, 'CD weight', '0.01', 0, 'cd_weight', 670);
INSERT INTO `settings` VALUES(111, 'flow', '', 1, 'flow', 175);



CREATE TABLE `shipping` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `shipping_time` varchar(100) default NULL,
  `activ` tinyint(4) default NULL,
  `methods` varchar(100) default NULL,
  `methods_calculation` varchar(100) default NULL,
  `taxes` tinyint(4) default NULL,
  `regions` tinyint(4) default NULL,
  `weight_min` int(11) default NULL,
  `weight_max` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `activ` (`activ`),
  KEY `weight_max` (`weight_max`),
  KEY `weight_min` (`weight_min`)
);



INSERT INTO `shipping` VALUES(8, 'DHL/Airborne', '2-3 days', 1, 'weight', 'currency', 1, 0, 0, 1000);
INSERT INTO `shipping` VALUES(6, 'UPS', '3-5 days', 1, 'weight', 'currency', 0, 0, 0, 100);



CREATE TABLE `shipping_ranges` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `price` float default NULL,
  `from_param` float default NULL,
  `to_param` float default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `to_param` (`to_param`),
  KEY `from_param` (`from_param`)
);



INSERT INTO `shipping_ranges` VALUES(82, 8, 75, 100, 1e+06);
INSERT INTO `shipping_ranges` VALUES(41, 6, 3, 2, 3);
INSERT INTO `shipping_ranges` VALUES(40, 6, 2, 1, 2);
INSERT INTO `shipping_ranges` VALUES(39, 6, 1, 0, 1);
INSERT INTO `shipping_ranges` VALUES(81, 8, 50, 0, 100);



CREATE TABLE `shipping_regions` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `country` varchar(250) default NULL,
  `state` varchar(250) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `country` (`country`),
  KEY `state` (`state`)
);



CREATE TABLE `sizes` (
  `id_parent` int(11) NOT NULL auto_increment,
  `size` int(11) default NULL,
  `description` varchar(200) default NULL,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `title` varchar(200) default NULL,
  `license` int(10) NOT NULL,
  KEY `license` (`license`),
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`)
);



INSERT INTO `sizes` VALUES(6892, 0, NULL, 125, 4, 'Electronic Items for Resale (unlimited run)', 4584);
INSERT INTO `sizes` VALUES(6891, 0, NULL, 125, 3, 'Items for Resale (limited run)', 4584);
INSERT INTO `sizes` VALUES(6890, 0, NULL, 125, 2, 'Unlimited Reproduction / Print Runs', 4584);
INSERT INTO `sizes` VALUES(6889, 0, NULL, 75, 1, 'Multi-Seat (unlimited)', 4584);
INSERT INTO `sizes` VALUES(6888, 0, NULL, 4, 4, 'Original size', 4583);
INSERT INTO `sizes` VALUES(6887, 900, NULL, 3, 3, 'Large', 4583);
INSERT INTO `sizes` VALUES(6885, 500, NULL, 1, 1, 'Small', 4583);
INSERT INTO `sizes` VALUES(6886, 800, NULL, 2, 2, 'Medium', 4583);
INSERT INTO `sizes` VALUES(6893, 0, NULL, 100, 5, 'Extended Legal Guarantee covers up to $250,000', 4584);



CREATE TABLE `structure` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `module_table` int(11) default NULL,
  `name` varchar(200) default NULL,
  `potential` int(11) default NULL,
  `prioritet` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`)
);



INSERT INTO `structure` VALUES(1, 0, 0, 'Support', 1, 0);
INSERT INTO `structure` VALUES(2, 0, 0, 'Customers', 1, 0);
INSERT INTO `structure` VALUES(4, 0, 0, 'News', 1, 0);
INSERT INTO `structure` VALUES(5, 0, 0, 'Catalog', 1, 0);
INSERT INTO `structure` VALUES(7, 0, 0, 'Reporting', 1, 0);
INSERT INTO `structure` VALUES(15, 3908, 25, 'Sign Up', NULL, 0);
INSERT INTO `structure` VALUES(7449, 3913, 34, 'Venezia', NULL, 0);
INSERT INTO `structure` VALUES(7450, 3913, 34, 'Firenze', NULL, 0);
INSERT INTO `structure` VALUES(4334, 3908, 25, 'Terms and Conditions', NULL, 0);
INSERT INTO `structure` VALUES(32, 0, 0, 'Payments', 1, 0);
INSERT INTO `structure` VALUES(36, 3908, 25, 'Forgot password', NULL, 0);
INSERT INTO `structure` VALUES(3918, 7474, 34, 'Animals', NULL, 0);
INSERT INTO `structure` VALUES(7452, 7449, 30, 'Venezia 2', NULL, 0);
INSERT INTO `structure` VALUES(3913, 5, 34, 'Cities', NULL, 0);
INSERT INTO `structure` VALUES(3914, 5, 34, 'Movies', NULL, 0);
INSERT INTO `structure` VALUES(7466, 7472, 30, 'Fortress', NULL, 0);
INSERT INTO `structure` VALUES(3924, 1, 33, 'User', NULL, 0);
INSERT INTO `structure` VALUES(4375, 5, 34, 'Sounds', NULL, 0);
INSERT INTO `structure` VALUES(4039, 4034, 25, 'Contacts', NULL, 0);
INSERT INTO `structure` VALUES(7671, 7474, 30, 'Moscow Kremlin', NULL, 0);
INSERT INTO `structure` VALUES(95, 7, 4, 'Stats', -1, 0);
INSERT INTO `structure` VALUES(96, 7, 6, 'Blocked IP', -1, 0);
INSERT INTO `structure` VALUES(97, 7, 7, 'Blocked Users', -1, 0);
INSERT INTO `structure` VALUES(7673, 7474, 30, 'Moscow Kremlin', NULL, 0);
INSERT INTO `structure` VALUES(7655, 7474, 31, 'Apple tree', NULL, 0);
INSERT INTO `structure` VALUES(7589, 7473, 30, 'IMG0811', NULL, 0);
INSERT INTO `structure` VALUES(7587, 7473, 30, 'Moscow Kremlin', NULL, 0);
INSERT INTO `structure` VALUES(108, 2, 28, 'amkarik@mail.ru', NULL, 0);
INSERT INTO `structure` VALUES(3923, 4, 26, 'First news', NULL, 0);
INSERT INTO `structure` VALUES(3908, 0, 0, 'Text pages', 1, 0);
INSERT INTO `structure` VALUES(3931, 2, 28, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(7451, 7449, 30, 'Venezia 1', NULL, 0);
INSERT INTO `structure` VALUES(7457, 7450, 30, 'Firenze 1', NULL, 0);
INSERT INTO `structure` VALUES(7465, 7474, 30, 'Snow Garden', NULL, 0);
INSERT INTO `structure` VALUES(7454, 7449, 30, 'Venezia 4', NULL, 0);
INSERT INTO `structure` VALUES(7455, 7449, 30, 'Venezia 5', NULL, 0);
INSERT INTO `structure` VALUES(7456, 7449, 30, 'Venezia 6', NULL, 0);
INSERT INTO `structure` VALUES(7453, 7449, 30, 'Venezia 3', NULL, 0);
INSERT INTO `structure` VALUES(3992, 0, 0, 'Coupons', NULL, 0);
INSERT INTO `structure` VALUES(3993, 3992, 0, 'Types of Coupons', 1, 2);
INSERT INTO `structure` VALUES(3994, 3992, 0, 'List of Current Coupons', 1, 1);
INSERT INTO `structure` VALUES(4012, 0, 0, 'Top navigation', 1, 0);
INSERT INTO `structure` VALUES(4013, 0, 0, 'Bottom navigation', 1, 0);
INSERT INTO `structure` VALUES(4014, 0, 0, 'Side boxes', 1, 0);
INSERT INTO `structure` VALUES(4016, 4012, 38, 'About', NULL, 0);
INSERT INTO `structure` VALUES(4017, 4012, 38, 'News', NULL, 0);
INSERT INTO `structure` VALUES(4018, 4012, 38, 'Contacts', NULL, 0);
INSERT INTO `structure` VALUES(4020, 4013, 38, 'About', NULL, 0);
INSERT INTO `structure` VALUES(4021, 4013, 38, 'News', NULL, 0);
INSERT INTO `structure` VALUES(4022, 4013, 38, 'Contacts', NULL, 0);
INSERT INTO `structure` VALUES(4023, 4014, 39, 'Categories', NULL, 0);
INSERT INTO `structure` VALUES(4026, 4014, 39, 'Shopping Cart', NULL, 0);
INSERT INTO `structure` VALUES(4028, 4014, 39, 'News', NULL, 0);
INSERT INTO `structure` VALUES(4029, 4014, 39, 'Member Area', NULL, 0);
INSERT INTO `structure` VALUES(4031, 4014, 39, 'Stock', NULL, 0);
INSERT INTO `structure` VALUES(4032, 4014, 39, 'Photographers', NULL, 0);
INSERT INTO `structure` VALUES(4033, 4014, 39, 'Advertisement', NULL, 0);
INSERT INTO `structure` VALUES(4034, 0, 0, 'Site info', 1, 0);
INSERT INTO `structure` VALUES(4035, 4034, 25, 'About', NULL, 0);
INSERT INTO `structure` VALUES(4036, 4034, 25, 'Support', NULL, 0);
INSERT INTO `structure` VALUES(4037, 4034, 25, 'Privacy Policy', NULL, 0);
INSERT INTO `structure` VALUES(4038, 4034, 25, 'FAQ', NULL, 0);
INSERT INTO `structure` VALUES(4040, 4014, 39, 'Stat', NULL, 0);
INSERT INTO `structure` VALUES(4133, 0, 0, 'Messages', 1, 0);
INSERT INTO `structure` VALUES(4051, 0, 0, 'Customers categories', 1, 0);
INSERT INTO `structure` VALUES(4052, 4051, 40, 'Gold', NULL, 0);
INSERT INTO `structure` VALUES(4053, 4051, 40, 'Silver', NULL, 0);
INSERT INTO `structure` VALUES(4054, 4051, 40, 'Bronze', NULL, 0);
INSERT INTO `structure` VALUES(7670, 7474, 30, 'IMG1608', NULL, 0);
INSERT INTO `structure` VALUES(7467, 7472, 30, 'Mill', NULL, 0);
INSERT INTO `structure` VALUES(7468, 3918, 30, 'Mew', NULL, 0);
INSERT INTO `structure` VALUES(7469, 3918, 30, 'Mews', NULL, 0);
INSERT INTO `structure` VALUES(7470, 7472, 30, 'Monastery ', NULL, 0);
INSERT INTO `structure` VALUES(4096, 0, 0, 'Photo sizes', 1, 0);
INSERT INTO `structure` VALUES(4113, 2, 28, 'demo2', NULL, 0);
INSERT INTO `structure` VALUES(4121, 4014, 39, 'Search', NULL, 0);
INSERT INTO `structure` VALUES(4122, 0, 0, 'Prints types', 1, 0);
INSERT INTO `structure` VALUES(4123, 4122, 42, 'Framed', NULL, 0);
INSERT INTO `structure` VALUES(4124, 4122, 42, 'XL T-Shirt', NULL, 0);
INSERT INTO `structure` VALUES(4125, 4122, 42, 'Matte 8x10', NULL, 0);
INSERT INTO `structure` VALUES(4126, 4122, 42, 'Glossy 8x10', NULL, 0);
INSERT INTO `structure` VALUES(4127, 4122, 42, 'Matte 5x7', NULL, 0);
INSERT INTO `structure` VALUES(4128, 4122, 42, 'Glossy 5x7', NULL, 0);
INSERT INTO `structure` VALUES(4131, 2, 28, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4132, 2, 28, 'john', NULL, 0);
INSERT INTO `structure` VALUES(4148, 4133, 43, 'boby', NULL, 0);
INSERT INTO `structure` VALUES(4147, 4133, 43, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4146, 4133, 43, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4143, 4133, 43, 'john', NULL, 0);
INSERT INTO `structure` VALUES(4142, 4133, 43, 'boby', NULL, 0);
INSERT INTO `structure` VALUES(4149, 0, 0, 'Reviews', 1, 0);
INSERT INTO `structure` VALUES(4150, 0, 0, 'Testimonials', 1, 0);
INSERT INTO `structure` VALUES(4155, 4149, 44, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4154, 4149, 44, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4156, 4149, 44, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4159, 0, 0, 'Blog categories', 1, 0);
INSERT INTO `structure` VALUES(4160, 4159, 48, 'Photo', NULL, 0);
INSERT INTO `structure` VALUES(4161, 4149, 44, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4162, 4149, 44, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4163, 4159, 48, 'Video', NULL, 0);
INSERT INTO `structure` VALUES(4164, 4159, 48, '1', NULL, 0);
INSERT INTO `structure` VALUES(4165, 4159, 48, '', NULL, 0);
INSERT INTO `structure` VALUES(4166, 0, 0, 'Blog', 1, 0);
INSERT INTO `structure` VALUES(4167, 4166, 47, 'Hello world!', NULL, 0);
INSERT INTO `structure` VALUES(4170, 4166, 47, 'Hello world!', NULL, 0);
INSERT INTO `structure` VALUES(4174, 4166, 47, 'Second post', NULL, 0);
INSERT INTO `structure` VALUES(4175, 0, 0, 'Blog comments', 1, 0);
INSERT INTO `structure` VALUES(4196, 4150, 45, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4197, 4150, 45, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4198, 4150, 45, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4202, 4150, 45, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4203, 4150, 45, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4204, 4150, 45, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4205, 4150, 45, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4206, 4175, 49, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4207, 4175, 49, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4208, 4175, 49, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4209, 4166, 47, 'My first post', NULL, 0);
INSERT INTO `structure` VALUES(4210, 4175, 49, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4215, 4159, 48, 'Funny', NULL, 0);
INSERT INTO `structure` VALUES(4212, 4175, 49, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4213, 4175, 49, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4216, 4159, 48, 'Jokes', NULL, 0);
INSERT INTO `structure` VALUES(7672, 7474, 30, 'IMG1608', NULL, 0);
INSERT INTO `structure` VALUES(4223, 0, 0, 'Prints', 1, 0);
INSERT INTO `structure` VALUES(4433, 32, 29, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(7473, 3918, 34, 'Birds', NULL, 0);
INSERT INTO `structure` VALUES(4377, 5, 34, 'Illustrations', NULL, 0);
INSERT INTO `structure` VALUES(4379, 0, 0, 'Download links', 1, 0);
INSERT INTO `structure` VALUES(4380, 0, 0, 'Credits', 1, 0);
INSERT INTO `structure` VALUES(7657, 7473, 52, 'Yellowhammer', NULL, 0);
INSERT INTO `structure` VALUES(4419, 0, 0, 'Credits list', 1, 0);
INSERT INTO `structure` VALUES(4455, 0, 0, 'Subscription', 1, 0);
INSERT INTO `structure` VALUES(4456, 0, 0, 'Subscription list', 1, 0);
INSERT INTO `structure` VALUES(4457, 0, 0, 'Content type', 1, 0);
INSERT INTO `structure` VALUES(7498, 3908, 25, 'Customer agreement', NULL, 0);
INSERT INTO `structure` VALUES(7519, 4149, 44, 'buyer', NULL, 0);
INSERT INTO `structure` VALUES(4476, 4014, 39, 'Tag clouds', NULL, 0);
INSERT INTO `structure` VALUES(4475, 4014, 39, 'Subscription', NULL, 0);
INSERT INTO `structure` VALUES(5995, 0, 0, 'Model Property Release', 1, 0);
INSERT INTO `structure` VALUES(6205, 5995, 67, 'sdfsd', NULL, 0);
INSERT INTO `structure` VALUES(4801, 4796, 64, 'MP3', NULL, 0);
INSERT INTO `structure` VALUES(4580, 0, 0, 'License', 1, 0);
INSERT INTO `structure` VALUES(4584, 4580, 61, 'Extended', NULL, 0);
INSERT INTO `structure` VALUES(4583, 4580, 61, 'Standart', NULL, 0);
INSERT INTO `structure` VALUES(7278, 3908, 25, 'Affiliate agreement', NULL, 0);
INSERT INTO `structure` VALUES(7471, 3913, 30, 'Sewer manhole', NULL, 0);
INSERT INTO `structure` VALUES(7472, 3913, 34, 'Architecture', NULL, 0);
INSERT INTO `structure` VALUES(4741, 4740, 62, 'Google 468x60', NULL, 0);
INSERT INTO `structure` VALUES(4740, 0, 0, 'Ads', 1, 0);
INSERT INTO `structure` VALUES(4745, 4740, 62, 'Google 728x90', NULL, 0);
INSERT INTO `structure` VALUES(4778, 4133, 43, 'siteowner', NULL, 0);
INSERT INTO `structure` VALUES(4777, 4133, 43, 'demo2', NULL, 0);
INSERT INTO `structure` VALUES(4776, 4133, 43, 'demo', NULL, 0);
INSERT INTO `structure` VALUES(4779, 4133, 43, 'john', NULL, 0);
INSERT INTO `structure` VALUES(4795, 0, 0, 'Video types', 1, 0);
INSERT INTO `structure` VALUES(4796, 0, 0, 'Audio types', 1, 0);
INSERT INTO `structure` VALUES(4797, 0, 0, 'Vector types', 1, 0);
INSERT INTO `structure` VALUES(4798, 4795, 63, 'QuickTime', NULL, 0);
INSERT INTO `structure` VALUES(4799, 4795, 63, 'AVI', NULL, 0);
INSERT INTO `structure` VALUES(4800, 4795, 63, 'WMV', NULL, 0);
INSERT INTO `structure` VALUES(4802, 4796, 64, 'WAV', NULL, 0);
INSERT INTO `structure` VALUES(4804, 4797, 65, 'ZIP', NULL, 0);
INSERT INTO `structure` VALUES(4805, 4795, 63, 'FLV', NULL, 0);
INSERT INTO `structure` VALUES(7656, 7474, 31, 'Forest', NULL, 0);
INSERT INTO `structure` VALUES(4839, 4377, 53, 'Vector Illustration', NULL, 0);
INSERT INTO `structure` VALUES(7658, 7473, 52, 'Waxwing', NULL, 0);
INSERT INTO `structure` VALUES(5175, 2, 28, '1111111', NULL, 0);
INSERT INTO `structure` VALUES(5894, 4797, 65, 'Shipped CD', NULL, 0);
INSERT INTO `structure` VALUES(5893, 4796, 64, 'Shipped CD', NULL, 0);
INSERT INTO `structure` VALUES(5892, 4795, 63, 'Shipped CD', NULL, 0);
INSERT INTO `structure` VALUES(6251, 5, 34, 'Flash', NULL, 0);
INSERT INTO `structure` VALUES(6288, 3908, 25, 'Examination', NULL, 0);
INSERT INTO `structure` VALUES(6355, 2, 28, 'buyer', NULL, 0);
INSERT INTO `structure` VALUES(6354, 3908, 25, 'Seller agreement', NULL, 0);
INSERT INTO `structure` VALUES(6353, 3908, 25, 'Buyer agreement', NULL, 0);
INSERT INTO `structure` VALUES(6345, 3908, 25, 'Examination - Thank you', NULL, 0);
INSERT INTO `structure` VALUES(6360, 2, 28, 'seller', NULL, 0);
INSERT INTO `structure` VALUES(6359, 3908, 25, 'Seller lecture', NULL, 0);
INSERT INTO `structure` VALUES(7474, 5, 34, 'Nature', NULL, 0);
INSERT INTO `structure` VALUES(7460, 3918, 34, 'Cats', NULL, 0);
INSERT INTO `structure` VALUES(7461, 7460, 30, 'Small Cat', NULL, 0);
INSERT INTO `structure` VALUES(7458, 7450, 30, 'Firenze 2', NULL, 0);
INSERT INTO `structure` VALUES(7459, 7450, 30, 'Firenze 3', NULL, 0);
INSERT INTO `structure` VALUES(7462, 3918, 30, 'Thin Cat', NULL, 0);
INSERT INTO `structure` VALUES(7463, 3918, 30, 'Cat', NULL, 0);
INSERT INTO `structure` VALUES(7464, 3918, 30, 'Arrogant Cat', NULL, 0);
INSERT INTO `structure` VALUES(7292, 2, 28, 'affiliate', NULL, 0);
INSERT INTO `structure` VALUES(7176, 6251, 53, 'Flash example', NULL, 0);
INSERT INTO `structure` VALUES(7217, 3918, 52, '???°', NULL, 0);
INSERT INTO `structure` VALUES(7283, 4175, 49, 'affiliate', NULL, 0);
INSERT INTO `structure` VALUES(7381, 32, 29, 'Order _resh_85', NULL, 0);
INSERT INTO `structure` VALUES(7382, 32, 29, 'Order _resh_86', NULL, 0);
INSERT INTO `structure` VALUES(7588, 7473, 30, 'IMG0802', NULL, 0);
INSERT INTO `structure` VALUES(7403, 2, 28, 'common', NULL, 0);
INSERT INTO `structure` VALUES(7735, 5, 34, '???†?????†??', NULL, 0);
INSERT INTO `structure` VALUES(7713, 7712, 53, 'Cats', NULL, 0);
INSERT INTO `structure` VALUES(7712, 5, 34, 'CD collections', NULL, 0);



CREATE TABLE `subscription` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `price` float default NULL,
  `days` int(11) default NULL,
  `content_type` varchar(200) default NULL,
  `bandwidth` int(20) default NULL,
  `priority` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `content_type` (`content_type`),
  KEY `bandwidth` (`bandwidth`),
  KEY `days` (`days`),
  KEY `priority` (`priority`)
);



INSERT INTO `subscription` VALUES(4461, '1 day instant access', 10, 1, 'Common', 15, 1);
INSERT INTO `subscription` VALUES(4462, '1 month instant access', 100, 30, 'Common', 200, 2);
INSERT INTO `subscription` VALUES(4464, '1 day instant premium access', 50, 1, 'Common|Premium', 20, 3);
INSERT INTO `subscription` VALUES(4465, '1 month instant premium access', 300, 30, 'Common|Premium', 250, 4);



CREATE TABLE `subscription_limit` (
  `name` varchar(150) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `subscription_limit` VALUES('Credits', 1);
INSERT INTO `subscription_limit` VALUES('Downloads', 0);
INSERT INTO `subscription_limit` VALUES('Bandwidth', 0);



CREATE TABLE `subscription_list` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `user` varchar(200) default NULL,
  `data1` int(11) default NULL,
  `data2` int(11) default NULL,
  `bandwidth` double default NULL,
  `bandwidth_limit` int(40) default NULL,
  `subscription` int(11) default NULL,
  `approved` int(11) default NULL,
  `subtotal` float default NULL,
  `discount` float default NULL,
  `taxes` float default NULL,
  `total` float default NULL,
  `billing_firstname` varchar(250) default NULL,
  `billing_lastname` varchar(250) default NULL,
  `billing_address` varchar(250) default NULL,
  `billing_city` varchar(250) default NULL,
  `billing_zip` varchar(250) default NULL,
  `billing_country` varchar(250) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `user` (`user`),
  KEY `data1` (`data1`),
  KEY `data2` (`data2`),
  KEY `bandwidth` (`bandwidth`),
  KEY `bandwidth_limit` (`bandwidth_limit`),
  KEY `subscription` (`subscription`)
);



INSERT INTO `subscription_list` VALUES(21, '1 day instant access', 'buyer', 1321959094, 1322045494, 3, 15, 4461, 1, 10, 0, 0, 10, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `subscription_list` VALUES(7, '1 day instant access', 'common', 1318181794, 1318268194, 0, 15, 4461, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `subscription_list` VALUES(26, '1 day instant access', 'buyer', 1355489232, 1355575632, 0, 15, 4461, 1, 10, 0, 0, 10, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `subscription_list` VALUES(22, '1 day instant access', 'buyer', 1344715200, 1348603199, 0, 15, 4461, 1, 10, 0, 0, 10, 'John', 'Brown', '', 'Los Angeles', '', 'United States');
INSERT INTO `subscription_list` VALUES(18, '1 month instant access', 'common', 1319832000, 1322341199, 3, 150, 4462, 0, 10, 0, 0, 10, 'tester', 'tester', '', 'wqewq', '', 'Albania');



CREATE TABLE `support` (
  `id_parent` int(11) NOT NULL auto_increment,
  `name` varchar(200) default NULL,
  `email` varchar(200) default NULL,
  `telephone` varchar(200) default NULL,
  `question` text,
  `username` varchar(200) default NULL,
  `status` varchar(200) default NULL,
  `data` int(11) default NULL,
  `method` varchar(200) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`)
);



INSERT INTO `support` VALUES(3927, 'John', 'john@mail.com', '+12323423424', 'Why?', NULL, NULL, 1334318550, 'by e-mail');



CREATE TABLE `tax` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) default NULL,
  `rates_depend` int(11) default NULL,
  `price_include` int(11) default NULL,
  `rate_all` float default NULL,
  `rate_all_type` int(11) default NULL,
  `enabled` int(11) default NULL,
  `regions` int(11) default NULL,
  `files` tinyint(4) default NULL,
  `credits` tinyint(4) default NULL,
  `subscription` tinyint(4) default NULL,
  `customer` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `tax` VALUES(3, 'VAT', 2, 0, 10, 1, 1, 0, 1, 1, 1, 0);



CREATE TABLE `tax_regions` (
  `id` int(11) NOT NULL auto_increment,
  `id_parent` int(11) default NULL,
  `country` varchar(250) default NULL,
  `state` varchar(250) default NULL,
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`),
  KEY `country` (`country`),
  KEY `state` (`state`)
);



CREATE TABLE `templates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `activ` int(11) default NULL,
  `home` int(11) default NULL,
  `shome` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `templates` VALUES(41, 'Template 17', 'templates/template17/', 0, 3, 1);
INSERT INTO `templates` VALUES(40, 'Template 16', 'templates/template16/', 0, 3, 1);
INSERT INTO `templates` VALUES(39, 'Template 15', 'templates/template15/', 0, 3, 1);
INSERT INTO `templates` VALUES(48, 'Template 22', 'templates/template22/', 0, 3, 1);
INSERT INTO `templates` VALUES(43, 'Template 19', 'templates/template19/', 0, 3, 1);
INSERT INTO `templates` VALUES(46, 'Template 20', 'templates/template20/', 0, 3, 1);
INSERT INTO `templates` VALUES(47, 'Template 21', 'templates/template21/', 1, 3, 1);
INSERT INTO `templates` VALUES(42, 'Template 18', 'templates/template18/', 0, 3, 1);



CREATE TABLE `testimonials` (
  `id_parent` int(11) NOT NULL auto_increment,
  `touser` varchar(200) default NULL,
  `fromuser` varchar(200) default NULL,
  `content` text,
  `data` int(11) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `touser` (`touser`),
  KEY `fromuser` (`fromuser`),
  KEY `data` (`data`)
);



INSERT INTO `testimonials` VALUES(4202, 'siteowner', 'demo', 'I love him photos a lot!!!', 1195339422);
INSERT INTO `testimonials` VALUES(4204, 'demo', 'siteowner', 'Very good artworks!!!', 1195339778);



CREATE TABLE `users` (
  `id_parent` int(11) NOT NULL auto_increment,
  `login` varchar(200) default NULL,
  `password` varchar(200) default NULL,
  `name` varchar(200) default NULL,
  `email` varchar(200) default NULL,
  `telephone` varchar(200) default NULL,
  `address` text,
  `data1` int(11) default NULL,
  `ip` varchar(200) default NULL,
  `accessdenied` int(11) default NULL,
  `country` varchar(200) default NULL,
  `category` varchar(200) default NULL,
  `lastname` varchar(200) default NULL,
  `city` varchar(200) default NULL,
  `zipcode` varchar(200) default NULL,
  `avatar` varchar(200) default NULL,
  `photo` varchar(200) default NULL,
  `description` text,
  `website` varchar(200) default NULL,
  `utype` varchar(200) default NULL,
  `company` varchar(200) default NULL,
  `newsletter` int(11) default NULL,
  `paypal` varchar(200) default NULL,
  `moneybookers` varchar(200) default NULL,
  `examination` int(11) default NULL,
  `passport` varchar(200) default NULL,
  `authorization` varchar(50) default NULL,
  `aff_commission_buyer` float default NULL,
  `aff_commission_seller` float default NULL,
  `aff_visits` int(11) default NULL,
  `aff_signups` int(11) default NULL,
  `aff_referal` int(11) default NULL,
  `state` varchar(250) default NULL,
  `dwolla` varchar(200) default NULL,
  `webmoney` varchar(200) default NULL,
  `qiwi` varchar(200) default NULL,
  `business` tinyint(4) default NULL,
  `bank_account` varchar(200) default NULL,
  `bank_name` varchar(50) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `login` (`login`),
  KEY `data1` (`data1`),
  KEY `authorization` (`authorization`),
  KEY `aff_visits` (`aff_visits`),
  KEY `aff_signups` (`aff_signups`),
  KEY `aff_referal` (`aff_referal`)
);



INSERT INTO `users` VALUES(3931, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Nick', 'demo@cmsaccount.com', '1(123)232-24-34', 'Sunnyway Rd, 21', 1169233200, '127.0.0.1', 0, 'United States', 'Gold', 'Brown', 'Los Angeles', '90210', '/content/avatars/avatar_demo.gif', '/content/users/photo_demo.jpg', 'I am a good photographer.', 'www.google.com', 'seller', 'Firm Inc.', 1, 'sales@cmsaccount.com', 'sales@cmsaccount.com', 1, NULL, 'site', 0, 0, NULL, NULL, 7292, '', '210-268-9238', 'Z160139856701', '9062496570', 0, '123456789', 'Privatbank');
INSERT INTO `users` VALUES(4113, 'demo2', '1066726e7160bd9c987c9968e0cc275a', 'Jeff', 'demo2@cmsaccount.com', '212321323', '1st Rd.', 1228760057, '127.0.0.1', 0, 'USA', 'Silver', 'Ri_char_ds', 'New York', '12345', '', '', '', 'www.domain.com', 'buyer', '', 1, '', '', 0, NULL, 'site', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO `users` VALUES(4131, 'siteowner', 'f06b354fe25b904c78083d6708fb71ab', 'Boby', 'sales@cmsaccount.com', '', '', 1193140455, '', 0, '', 'Gold', 'Ri_char_ds', 'Los Angeles', '90210', '/content/avatars/avatar1240915546.gif', '/content/users/photo1240915546.jpg', 'Very good photographer.&lt;br /&gt;&lt;br /&gt;Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&lt;br /&gt;', 'www.yahoo.com', 'seller', 'Company Inc.', 1, 'payout@cmsaccount.com', 'sales@cmsaccount.com', 0, NULL, 'site', 0, 0, NULL, NULL, NULL, '', '', '', '', 0, NULL, NULL);
INSERT INTO `users` VALUES(4132, 'john', 'a66e44736e753d4533746ced572ca821', 'John', 'sales@cmsaccount.com', '', '', 1193140555, '', 0, 'Canada', 'Silver', 'Smith', 'Ottava', '', '/content/avatars/avatar1240915571.gif', '/content/users/photo1240915571.jpg', 'Excellent photographer.', 'www.msn.com', 'seller', '', 1, '', '', NULL, NULL, 'site', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO `users` VALUES(6355, 'buyer', '794aad24cbd58461011ed9094b7fa212', 'John', 'buyer@cmsaccount.com', '', '', 1244146298, '127.0.0.1', 0, 'United States', 'Silver', 'Brown', 'Los Angeles', '', NULL, NULL, '', 'http://www.google.com', 'buyer', '', 1, '', '', 0, NULL, 'site', 0, 0, NULL, NULL, 7292, '', NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO `users` VALUES(6360, 'seller', '64c9ac2bb5fe46c3ac32844bb97be6bc', 'Nick', 'seller@cmsaccount.com', '', '', 1244150390, '127.0.0.1', 0, 'United States', 'Silver', 'Nickson', 'New York', '', NULL, NULL, '', '', 'seller', '', 1, '', '', 1, '/content/users/passport_.jpg', 'site', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL);
INSERT INTO `users` VALUES(7292, 'affiliate', '6d0bd9c8d2eadeb088b34895fde10c55', 'Jacob', 'affiliate@cmsaccount.com', '', '', 1301571281, '127.0.0.1', 0, 'Austria', 'Silver', 'Johnson', 'Wien', '', NULL, NULL, '', '', 'affiliate', '', 1, 'paypal@cmsaccount.com', 'moneybookers@cmsaccount.com', 0, NULL, 'site', 15, 10, 4, 0, 0, '', '210-268-9238', 'Z160139856701', '10859', 0, '1234-5678-1234-56781', 'VTB24');
INSERT INTO `users` VALUES(7403, 'common', '9efab2399c7c560b34de477b9aa0a465', 'Bob', 'common@cmsaccount.com', '', '', 1318176792, '127.0.0.1', 0, 'Austria', 'Silver', 'Smith', 'Wien', '', NULL, NULL, '', '', 'common', '', 1, 'sales@cmsaccount.com', 'sales@cmsaccount.com', 1, NULL, 'site', 15, 10, 0, 0, 0, '', '210-268-9238', 'Z160139856701', '10859', 0, '1234-5678-1234-5678', 'VTB24');
INSERT INTO `users` VALUES(7435, 'seller2', 'c30248d146039dd086b12f18154863e1', 'seller2', 'seller2@cmsaccount.com', '', '', 1360235342, '127.0.0.1', 0, 'Austria', 'Silver', 'seller2', '', '', NULL, NULL, NULL, '', 'common', '', 1, NULL, NULL, 1, NULL, 'site', 15, 10, 0, 0, 0, '', NULL, NULL, NULL, 0, NULL, NULL);



CREATE TABLE `users_access` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) default NULL,
  `data` int(50) default NULL,
  `ip` varchar(200) default NULL,
  `bandwidth` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `user` (`user`),
  KEY `data` (`data`)
);



INSERT INTO `users_access` VALUES(722, 7435, 1376838774, '127.0.0.1', 0);
INSERT INTO `users_access` VALUES(723, 7441, 1376838839, '127.0.0.1', 0);
INSERT INTO `users_access` VALUES(724, 3931, 1376839079, '127.0.0.1', 0);
INSERT INTO `users_access` VALUES(725, 6355, 1376841319, '127.0.0.1', 0);



CREATE TABLE `users_ip_blocked` (
  `ip` varchar(150) default NULL,
  `data` int(11) default NULL
);



CREATE TABLE `users_login_failed` (
  `login` varchar(250) default NULL,
  `password` varchar(250) default NULL,
  `data` int(11) default NULL,
  `ip` varchar(150) default NULL,
  KEY `ip` (`ip`),
  KEY `login` (`login`),
  KEY `data` (`data`)
);



CREATE TABLE `users_qauth` (
  `title` varchar(50) default NULL,
  `consumer_key` varchar(250) default NULL,
  `consumer_secret` varchar(250) default NULL,
  `request_token_url` varchar(250) default NULL,
  `access_token_url` varchar(250) default NULL,
  `authorize_url` varchar(250) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `users_qauth` VALUES('Twitter', 'snlPXUlvzPHkzR1Kyv4MMA', '9feJCd6CnezgKwi17Onu3MUppCanxleS6kezR2nqAs', 'https://api.twitter.com/oauth/request_token', 'https://api.twitter.com/oauth/access_token', 'https://api.twitter.com/oauth/authorize', 1);
INSERT INTO `users_qauth` VALUES('Facebook', '210749745608292', 'cf261435ee47d74e6cf4d5978b3c9ad0', '', '', '', 1);
INSERT INTO `users_qauth` VALUES('Vkontakte', '3219044', 'st5FsKHfXXOcJSH4PE5V', '', '', '', 1);
INSERT INTO `users_qauth` VALUES('Instagram', '3b3ace34d2a1471b882ea070bfa21af7', '523e22d8ba094d318d1c8b703fdea347', NULL, NULL, NULL, 1);



CREATE TABLE `users_settings` (
  `title` varchar(250) default NULL,
  `svalue` varchar(20) default NULL,
  `activ` int(11) default NULL
);



INSERT INTO `users_settings` VALUES('Activation disabled', 'off', 0);
INSERT INTO `users_settings` VALUES('Activation enabled', 'on', 1);
INSERT INTO `users_settings` VALUES('Activation by user', 'user', 0);
INSERT INTO `users_settings` VALUES('Activation by admin', 'admin', 0);


CREATE TABLE `users_signup` (
  `param` int(11) default NULL
);



INSERT INTO `users_signup` VALUES(1);



CREATE TABLE `user_category` (
  `id_parent` int(11) NOT NULL auto_increment,
  `category` int(11) default NULL,
  `upload` int(11) default NULL,
  `percentage` int(11) default NULL,
  `name` varchar(200) default NULL,
  `upload2` int(11) default NULL,
  `priority` int(11) default NULL,
  `videolimit` int(11) default NULL,
  `previewvideolimit` int(11) default NULL,
  `photolimit` int(11) default NULL,
  `blog` int(11) default NULL,
  `menu` int(11) default NULL,
  `upload3` int(11) default NULL,
  `audiolimit` int(11) default NULL,
  `previewaudiolimit` int(11) default NULL,
  `upload4` int(11) default NULL,
  `vectorlimit` int(11) default NULL,
  KEY `id_parent` (`id_parent`)
);



INSERT INTO `user_category` VALUES(4052, 1, 1, 25, 'Gold', 1, 1, 250, 10, 5, 1, 1, 1, 50, 5, 1, 20);
INSERT INTO `user_category` VALUES(4053, 1, 1, 25, 'Silver', 1, 2, 50, 10, 10, 1, 0, 1, 20, 2, 1, 15);
INSERT INTO `user_category` VALUES(4054, 0, 1, 25, 'Bronze', 0, 3, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0);



CREATE TABLE `vector` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `description` text,
  `keywords` text,
  `author` varchar(50) default NULL,
  `data` int(11) default NULL,
  `viewed` int(11) default NULL,
  `published` tinyint(1) default NULL,
  `featured` tinyint(1) default NULL,
  `userid` int(11) default NULL,
  `folder` varchar(50) default NULL,
  `content_type` varchar(50) default NULL,
  `free` tinyint(1) default NULL,
  `downloaded` int(11) default NULL,
  `rating` float default NULL,
  `model` int(10) default NULL,
  `flash_width` int(11) default NULL,
  `flash_height` int(11) default NULL,
  `server1` int(11) default NULL,
  `server2` int(11) default NULL,
  `server3` tinyint(1) default NULL,
  `examination` tinyint(1) default NULL,
  `flash_version` varchar(50) default NULL,
  `script_version` varchar(50) default NULL,
  `category2` int(11) default NULL,
  `category3` int(11) default NULL,
  `google_x` double default NULL,
  `google_y` double default NULL,
  `refuse_reason` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `adult` tinyint(4) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `title` (`title`),
  KEY `data` (`data`),
  KEY `published` (`published`),
  KEY `featured` (`featured`),
  KEY `viewed` (`viewed`),
  KEY `downloaded` (`downloaded`),
  KEY `free` (`free`),
  KEY `author` (`author`),
  KEY `userid` (`userid`),
  KEY `rating` (`rating`),
  KEY `model` (`model`),
  KEY `examination` (`examination`),
  KEY `category2` (`category2`),
  KEY `category3` (`category3`),
  KEY `google_x` (`google_x`),
  KEY `google_y` (`google_y`),
  KEY `server1` (`server1`),
  KEY `server2` (`server2`),
  KEY `adult` (`adult`)
);



INSERT INTO `vector` VALUES(4839, 'Vector Illustration', 'Abstract', 'vector,illustration', 'siteowner', 1217486920, 110, 1, 0, NULL, '4839', 'Common', 0, 5, 2, 0, 0, 0, 1, 0, NULL, 0, '', '', 5, 5, 0, 0, NULL, '/stock-vector/vector-illustration-4839.html', 0);
INSERT INTO `vector` VALUES(7176, 'Flash example', '', 'flash', 'demo', 1292931298, 45, 1, 0, 0, '7176', 'Common', 0, 1, NULL, 0, 0, 0, 2, 0, NULL, 0, '', '', 5, 5, 0, 0, NULL, '/stock-vector/flash-example-7176.html', 0);
INSERT INTO `vector` VALUES(7713, 'Cats', 'Many cats', 'cats', 'common', 1365161510, 43, 1, 0, 0, '7713', 'Common', 0, 0, NULL, 0, 0, 0, 2, 0, NULL, 0, '', '', 5, 5, 0, 0, NULL, '/stock-vector/cats-7713.html', 0);



CREATE TABLE `vector_types` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `types` varchar(200) default NULL,
  `price` float default NULL,
  `priority` int(11) default NULL,
  `shipped` int(11) default NULL,
  `license` int(10) NOT NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`),
  KEY `license` (`license`)
);



INSERT INTO `vector_types` VALUES(4804, 'ZIP', 'zip', 5, 2, 0, 4583);
INSERT INTO `vector_types` VALUES(5894, 'Shipped CD', 'shipped', 10, 5, 1, 4583);
INSERT INTO `vector_types` VALUES(6786, 'ZIP', 'zip', 50, 0, 0, 4584);
INSERT INTO `vector_types` VALUES(6787, 'Shipped CD', 'shipped', 100, 5, 1, 4584);



CREATE TABLE `videos` (
  `id_parent` int(11) default NULL,
  `title` varchar(200) default NULL,
  `data` int(11) default NULL,
  `published` tinyint(1) default NULL,
  `description` text,
  `folder` varchar(50) default NULL,
  `featured` tinyint(1) default NULL,
  `viewed` int(11) default NULL,
  `author` varchar(50) default NULL,
  `keywords` varchar(200) default NULL,
  `userid` int(11) default NULL,
  `usa` text,
  `duration` int(10) default NULL,
  `format` varchar(50) default NULL,
  `ratio` varchar(50) default NULL,
  `rendering` varchar(50) default NULL,
  `holder` varchar(50) default NULL,
  `frames` varchar(50) default NULL,
  `content_type` varchar(50) default NULL,
  `free` tinyint(1) default NULL,
  `downloaded` int(11) default NULL,
  `rating` float default NULL,
  `model` int(10) default NULL,
  `server1` int(11) default NULL,
  `server2` int(11) default NULL,
  `server3` tinyint(1) default NULL,
  `examination` tinyint(1) default NULL,
  `category2` int(11) default NULL,
  `category3` int(11) default NULL,
  `google_x` double default NULL,
  `google_y` double default NULL,
  `refuse_reason` varchar(250) default NULL,
  `url` varchar(250) default NULL,
  `adult` tinyint(4) default NULL,
  KEY `id_parent` (`id_parent`),
  KEY `data` (`data`),
  KEY `title` (`title`),
  KEY `published` (`published`),
  KEY `featured` (`featured`),
  KEY `viewed` (`viewed`),
  KEY `downloaded` (`downloaded`),
  KEY `free` (`free`),
  KEY `userid` (`userid`),
  KEY `author` (`author`),
  KEY `rating` (`rating`),
  KEY `examination` (`examination`),
  KEY `category2` (`category2`),
  KEY `category3` (`category3`),
  KEY `google_x` (`google_x`),
  KEY `google_y` (`google_y`),
  KEY `server1` (`server1`),
  KEY `server2` (`server2`),
  KEY `duration` (`duration`),
  KEY `adult` (`adult`)
);


INSERT INTO `videos` VALUES(7656, 'Forest', 1361095640, 1, '', '7656', 0, 16, 'common', 'nature,forest', 0, '', 11, 'DV / MiniDV / DVCam', '16:9 native', 'Interlaced', 'John Smith', 'PAL', 'Common', 0, 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 0, 0, NULL, '/stock-video/forest-7656.html', 0);
INSERT INTO `videos` VALUES(7655, 'Apple tree', 1361095355, 1, 'The apple blossoms.', '7655', 0, 6, 'common', 'apple,nature,blossom,flower', 0, '', 17, 'DV / MiniDV / DVCam', '16:9 native', 'Interlaced', 'John Smith', 'PAL', 'Common', 0, 0, NULL, 0, 2, 0, NULL, 0, 5, 5, 0, 0, NULL, '/stock-video/apple-tree-7655.html', 0);



CREATE TABLE `video_fields` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `priority` int(11) default NULL,
  `activ` int(11) default NULL,
  `required` int(11) default NULL,
  `always` int(11) default NULL,
  `fname` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `video_fields` VALUES(1, 'category', 1, 1, 1, 1, 'folder');
INSERT INTO `video_fields` VALUES(2, 'title', 2, 1, 1, 1, 'title');
INSERT INTO `video_fields` VALUES(3, 'description', 3, 1, 1, 0, 'description');
INSERT INTO `video_fields` VALUES(4, 'keywords', 4, 1, 1, 0, 'keywords');
INSERT INTO `video_fields` VALUES(5, 'file for sale', 5, 1, 1, 1, 'sale');
INSERT INTO `video_fields` VALUES(6, 'preview video', 6, 1, 1, 1, 'previewvideo');
INSERT INTO `video_fields` VALUES(7, 'preview picture', 7, 1, 1, 1, 'previewpicture');
INSERT INTO `video_fields` VALUES(9, 'U.S. 2257 Information', 15, 0, 0, 0, 'usa');
INSERT INTO `video_fields` VALUES(10, 'duration', 9, 1, 1, 0, 'duration');
INSERT INTO `video_fields` VALUES(11, 'clip format', 10, 1, 0, 0, 'format');
INSERT INTO `video_fields` VALUES(12, 'aspect ratio', 11, 1, 0, 0, 'ratio');
INSERT INTO `video_fields` VALUES(13, 'field rendering', 12, 1, 0, 0, 'rendering');
INSERT INTO `video_fields` VALUES(14, 'frames per second', 13, 1, 0, 0, 'frames');
INSERT INTO `video_fields` VALUES(15, 'copyright holder', 14, 1, 0, 0, 'holder');
INSERT INTO `video_fields` VALUES(16, 'terms and conditions', 16, 1, 1, 0, 'terms');



CREATE TABLE `video_format` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `video_format` VALUES(3, 'DV / MiniDV / DVCam');
INSERT INTO `video_format` VALUES(4, 'Beta sp');
INSERT INTO `video_format` VALUES(5, 'Digibeta');
INSERT INTO `video_format` VALUES(6, 'HDV');
INSERT INTO `video_format` VALUES(7, 'Other Hi-Def');
INSERT INTO `video_format` VALUES(8, '35mm film');
INSERT INTO `video_format` VALUES(9, '16mm film');
INSERT INTO `video_format` VALUES(10, '8mm film');
INSERT INTO `video_format` VALUES(11, 'Computer generated');
INSERT INTO `video_format` VALUES(12, 'Flash File');
INSERT INTO `video_format` VALUES(13, 'Other');



CREATE TABLE `video_frames` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `video_frames` VALUES(2, 'PAL');
INSERT INTO `video_frames` VALUES(3, 'NTSC');
INSERT INTO `video_frames` VALUES(4, 'HD1080');
INSERT INTO `video_frames` VALUES(5, 'HD720');
INSERT INTO `video_frames` VALUES(6, 'Other');



CREATE TABLE `video_ratio` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  `width` int(11) default NULL,
  `height` int(11) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `video_ratio` VALUES(2, '4:3', 4, 3);
INSERT INTO `video_ratio` VALUES(3, '16:9 native', 16, 9);
INSERT INTO `video_ratio` VALUES(4, '16:9 anamorphic', 16, 9);
INSERT INTO `video_ratio` VALUES(5, '16:9 letterboxed', 16, 9);
INSERT INTO `video_ratio` VALUES(8, 'Other', 4, 3);



CREATE TABLE `video_rendering` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
);



INSERT INTO `video_rendering` VALUES(2, 'Interlaced');
INSERT INTO `video_rendering` VALUES(3, 'Progressive scan');
INSERT INTO `video_rendering` VALUES(4, 'Other');



CREATE TABLE `video_types` (
  `id_parent` int(11) NOT NULL auto_increment,
  `title` varchar(200) default NULL,
  `priority` int(11) default NULL,
  `types` varchar(200) default NULL,
  `price` float default NULL,
  `shipped` int(11) default NULL,
  `license` int(10) NOT NULL,
  KEY `id_parent` (`id_parent`),
  KEY `priority` (`priority`),
  KEY `shipped` (`shipped`),
  KEY `license` (`license`)
);



INSERT INTO `video_types` VALUES(4798, 'QuickTime', 1, 'mov', 5, 0, 4583);
INSERT INTO `video_types` VALUES(4799, 'AVI', 2, 'avi', 6, 0, 4583);
INSERT INTO `video_types` VALUES(4800, 'WMV', 3, 'wmv', 3, 0, 4583);
INSERT INTO `video_types` VALUES(4805, 'FLV', 4, 'flv', 5, 0, 4583);
INSERT INTO `video_types` VALUES(5892, 'Shipped CD', 5, 'shipped', 10, 1, 4583);
INSERT INTO `video_types` VALUES(6775, 'AVI', 2, 'avi', 60, 0, 4584);
INSERT INTO `video_types` VALUES(6774, 'QuickTime', 1, 'mov', 50, 0, 4584);
INSERT INTO `video_types` VALUES(6776, 'WMV', 3, 'wmv', 30, 0, 4584);
INSERT INTO `video_types` VALUES(6777, 'FLV', 4, 'flv', 50, 0, 4584);
INSERT INTO `video_types` VALUES(6781, 'Shipped CD', 5, 'shipped', 100, 1, 4584);
INSERT INTO `video_types` VALUES(6784, 'MP4', 0, 'mp4', 5, 0, 4583);
INSERT INTO `video_types` VALUES(6786, 'MP4', 0, 'mp4', 40, 0, 4584);



CREATE TABLE `voteitems` (
  `id` int(11) default NULL,
  `ip` varchar(100) default NULL,
  `vote` int(11) default NULL,
  KEY `id` (`id`)
);



INSERT INTO `voteitems` VALUES(4817, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(5041, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(3988, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(4839, '127.0.0.1', 2);
INSERT INTO `voteitems` VALUES(4730, '127.0.0.1', 5);
INSERT INTO `voteitems` VALUES(3984, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(4736, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(6439, '127.0.0.1', 2);
INSERT INTO `voteitems` VALUES(6422, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(6429, '127.0.0.1', 1);
INSERT INTO `voteitems` VALUES(4815, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(6401, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(6259, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(4734, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(6470, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(3976, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(3973, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(3989, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(3975, '127.0.0.1', 3);
INSERT INTO `voteitems` VALUES(3974, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(6453, '127.0.0.1', 4);
INSERT INTO `voteitems` VALUES(7583, '127.0.0.1', 5);
INSERT INTO `voteitems` VALUES(7725, '127.0.0.1', 3);



CREATE TABLE `watermark` (
  `photo` varchar(250) default NULL,
  `position` int(11) default NULL
);



INSERT INTO `watermark` VALUES('/content/watermark.png', 5);
