/*
Navicat PGSQL Data Transfer

Source Server         : Postgres
Source Server Version : 90404
Source Host           : localhost:5432
Source Database       : testshop
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90404
File Encoding         : 65001

Date: 2017-05-10 19:36:04
*/


-- ----------------------------
-- Sequence structure for categories_id_seq
-- ----------------------------
DROP SEQUENCE "public"."categories_id_seq";
CREATE SEQUENCE "public"."categories_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 11
 CACHE 1;
SELECT setval('"public"."categories_id_seq"', 11, true);

-- ----------------------------
-- Sequence structure for categories_pos_seq
-- ----------------------------
DROP SEQUENCE "public"."categories_pos_seq";
CREATE SEQUENCE "public"."categories_pos_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 8
 CACHE 1;
SELECT setval('"public"."categories_pos_seq"', 8, true);

-- ----------------------------
-- Sequence structure for images_id_seq
-- ----------------------------
DROP SEQUENCE "public"."images_id_seq";
CREATE SEQUENCE "public"."images_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 152
 CACHE 1;
SELECT setval('"public"."images_id_seq"', 152, true);

-- ----------------------------
-- Sequence structure for order_id_seq
-- ----------------------------
DROP SEQUENCE "public"."order_id_seq";
CREATE SEQUENCE "public"."order_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for products_id_seq1
-- ----------------------------
DROP SEQUENCE "public"."products_id_seq1";
CREATE SEQUENCE "public"."products_id_seq1"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 284
 CACHE 1;
SELECT setval('"public"."products_id_seq1"', 284, true);

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 40
 CACHE 1;
SELECT setval('"public"."users_id_seq"', 40, true);

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS "public"."auth_assignment";
CREATE TABLE "public"."auth_assignment" (
"item_name" varchar(64) COLLATE "default" NOT NULL,
"user_id" varchar(64) COLLATE "default" NOT NULL,
"created_at" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO "public"."auth_assignment" VALUES ('admin', '34', null);
INSERT INTO "public"."auth_assignment" VALUES ('user', '33', null);

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."auth_item";
CREATE TABLE "public"."auth_item" (
"name" varchar(64) COLLATE "default" NOT NULL,
"type" int2 NOT NULL,
"description" text COLLATE "default",
"rule_name" varchar(64) COLLATE "default",
"data" bytea,
"created_at" int4,
"updated_at" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO "public"."auth_item" VALUES ('admin', '1', '', null, null, null, null);
INSERT INTO "public"."auth_item" VALUES ('user', '1', null, null, null, null, null);

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS "public"."auth_item_child";
CREATE TABLE "public"."auth_item_child" (
"parent" varchar(64) COLLATE "default" NOT NULL,
"child" varchar(64) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS "public"."auth_rule";
CREATE TABLE "public"."auth_rule" (
"name" varchar(64) COLLATE "default" NOT NULL,
"data" bytea,
"created_at" int4,
"updated_at" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS "public"."category";
CREATE TABLE "public"."category" (
"id" int4 DEFAULT nextval('categories_id_seq'::regclass) NOT NULL,
"name" varchar(250) COLLATE "default",
"pos" int4 DEFAULT nextval('categories_pos_seq'::regclass) NOT NULL,
"techname" varchar(250) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO "public"."category" VALUES ('8', 'Спиннинги', '0', 'Techname for Спиннинги');
INSERT INTO "public"."category" VALUES ('9', 'Катушки', '1', 'Techname for Катушки');
INSERT INTO "public"."category" VALUES ('10', 'Плетеные шнуры', '2', 'Techname for Плетеные шнуры');
INSERT INTO "public"."category" VALUES ('11', 'Офсетные крючки', '3', 'Techname for Офсетные крючки');

-- ----------------------------
-- Table structure for image
-- ----------------------------
DROP TABLE IF EXISTS "public"."image";
CREATE TABLE "public"."image" (
"id" int4 DEFAULT nextval('images_id_seq'::regclass) NOT NULL,
"product_id" int4 NOT NULL,
"pos" int4,
"img" varchar COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of image
-- ----------------------------
INSERT INTO "public"."image" VALUES ('149', '67', null, '10.05.20172015663689.jpg');
INSERT INTO "public"."image" VALUES ('150', '67', null, '10.05.20171738178608.jpg');
INSERT INTO "public"."image" VALUES ('151', '67', null, '10.05.2017718850168.jpg');

-- ----------------------------
-- Table structure for mm_category_product
-- ----------------------------
DROP TABLE IF EXISTS "public"."mm_category_product";
CREATE TABLE "public"."mm_category_product" (
"category_id" int4 NOT NULL,
"product_id" int4 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of mm_category_product
-- ----------------------------
INSERT INTO "public"."mm_category_product" VALUES ('8', '62');
INSERT INTO "public"."mm_category_product" VALUES ('8', '63');
INSERT INTO "public"."mm_category_product" VALUES ('8', '66');
INSERT INTO "public"."mm_category_product" VALUES ('8', '67');
INSERT INTO "public"."mm_category_product" VALUES ('8', '68');
INSERT INTO "public"."mm_category_product" VALUES ('8', '69');
INSERT INTO "public"."mm_category_product" VALUES ('8', '71');
INSERT INTO "public"."mm_category_product" VALUES ('8', '72');
INSERT INTO "public"."mm_category_product" VALUES ('8', '73');
INSERT INTO "public"."mm_category_product" VALUES ('8', '74');
INSERT INTO "public"."mm_category_product" VALUES ('8', '77');
INSERT INTO "public"."mm_category_product" VALUES ('8', '78');
INSERT INTO "public"."mm_category_product" VALUES ('8', '79');
INSERT INTO "public"."mm_category_product" VALUES ('8', '80');
INSERT INTO "public"."mm_category_product" VALUES ('8', '81');
INSERT INTO "public"."mm_category_product" VALUES ('8', '82');
INSERT INTO "public"."mm_category_product" VALUES ('8', '83');
INSERT INTO "public"."mm_category_product" VALUES ('8', '84');
INSERT INTO "public"."mm_category_product" VALUES ('8', '85');
INSERT INTO "public"."mm_category_product" VALUES ('8', '86');
INSERT INTO "public"."mm_category_product" VALUES ('8', '87');
INSERT INTO "public"."mm_category_product" VALUES ('8', '88');
INSERT INTO "public"."mm_category_product" VALUES ('8', '89');
INSERT INTO "public"."mm_category_product" VALUES ('8', '90');
INSERT INTO "public"."mm_category_product" VALUES ('8', '91');
INSERT INTO "public"."mm_category_product" VALUES ('8', '92');
INSERT INTO "public"."mm_category_product" VALUES ('8', '93');
INSERT INTO "public"."mm_category_product" VALUES ('8', '94');
INSERT INTO "public"."mm_category_product" VALUES ('8', '95');
INSERT INTO "public"."mm_category_product" VALUES ('8', '96');
INSERT INTO "public"."mm_category_product" VALUES ('8', '97');
INSERT INTO "public"."mm_category_product" VALUES ('8', '98');
INSERT INTO "public"."mm_category_product" VALUES ('8', '99');
INSERT INTO "public"."mm_category_product" VALUES ('8', '100');
INSERT INTO "public"."mm_category_product" VALUES ('8', '101');
INSERT INTO "public"."mm_category_product" VALUES ('8', '103');
INSERT INTO "public"."mm_category_product" VALUES ('8', '104');
INSERT INTO "public"."mm_category_product" VALUES ('8', '105');
INSERT INTO "public"."mm_category_product" VALUES ('8', '106');
INSERT INTO "public"."mm_category_product" VALUES ('8', '107');
INSERT INTO "public"."mm_category_product" VALUES ('8', '142');
INSERT INTO "public"."mm_category_product" VALUES ('9', '64');
INSERT INTO "public"."mm_category_product" VALUES ('9', '102');
INSERT INTO "public"."mm_category_product" VALUES ('9', '108');
INSERT INTO "public"."mm_category_product" VALUES ('9', '109');
INSERT INTO "public"."mm_category_product" VALUES ('9', '110');
INSERT INTO "public"."mm_category_product" VALUES ('9', '111');
INSERT INTO "public"."mm_category_product" VALUES ('9', '112');
INSERT INTO "public"."mm_category_product" VALUES ('9', '113');
INSERT INTO "public"."mm_category_product" VALUES ('9', '114');
INSERT INTO "public"."mm_category_product" VALUES ('9', '115');
INSERT INTO "public"."mm_category_product" VALUES ('9', '116');
INSERT INTO "public"."mm_category_product" VALUES ('9', '117');
INSERT INTO "public"."mm_category_product" VALUES ('9', '118');
INSERT INTO "public"."mm_category_product" VALUES ('9', '119');
INSERT INTO "public"."mm_category_product" VALUES ('9', '120');
INSERT INTO "public"."mm_category_product" VALUES ('9', '121');
INSERT INTO "public"."mm_category_product" VALUES ('9', '122');
INSERT INTO "public"."mm_category_product" VALUES ('9', '123');
INSERT INTO "public"."mm_category_product" VALUES ('9', '124');
INSERT INTO "public"."mm_category_product" VALUES ('9', '125');
INSERT INTO "public"."mm_category_product" VALUES ('9', '126');
INSERT INTO "public"."mm_category_product" VALUES ('9', '127');
INSERT INTO "public"."mm_category_product" VALUES ('9', '128');
INSERT INTO "public"."mm_category_product" VALUES ('9', '129');
INSERT INTO "public"."mm_category_product" VALUES ('9', '130');
INSERT INTO "public"."mm_category_product" VALUES ('9', '131');
INSERT INTO "public"."mm_category_product" VALUES ('9', '132');
INSERT INTO "public"."mm_category_product" VALUES ('9', '133');
INSERT INTO "public"."mm_category_product" VALUES ('9', '134');
INSERT INTO "public"."mm_category_product" VALUES ('9', '135');
INSERT INTO "public"."mm_category_product" VALUES ('9', '136');
INSERT INTO "public"."mm_category_product" VALUES ('9', '137');
INSERT INTO "public"."mm_category_product" VALUES ('9', '138');
INSERT INTO "public"."mm_category_product" VALUES ('9', '139');
INSERT INTO "public"."mm_category_product" VALUES ('9', '140');
INSERT INTO "public"."mm_category_product" VALUES ('9', '141');
INSERT INTO "public"."mm_category_product" VALUES ('9', '203');
INSERT INTO "public"."mm_category_product" VALUES ('9', '230');
INSERT INTO "public"."mm_category_product" VALUES ('10', '61');
INSERT INTO "public"."mm_category_product" VALUES ('10', '143');
INSERT INTO "public"."mm_category_product" VALUES ('10', '144');
INSERT INTO "public"."mm_category_product" VALUES ('10', '145');
INSERT INTO "public"."mm_category_product" VALUES ('10', '146');
INSERT INTO "public"."mm_category_product" VALUES ('10', '147');
INSERT INTO "public"."mm_category_product" VALUES ('10', '148');
INSERT INTO "public"."mm_category_product" VALUES ('10', '149');
INSERT INTO "public"."mm_category_product" VALUES ('10', '150');
INSERT INTO "public"."mm_category_product" VALUES ('10', '151');
INSERT INTO "public"."mm_category_product" VALUES ('10', '152');
INSERT INTO "public"."mm_category_product" VALUES ('10', '153');
INSERT INTO "public"."mm_category_product" VALUES ('10', '154');
INSERT INTO "public"."mm_category_product" VALUES ('10', '155');
INSERT INTO "public"."mm_category_product" VALUES ('10', '156');
INSERT INTO "public"."mm_category_product" VALUES ('10', '157');
INSERT INTO "public"."mm_category_product" VALUES ('10', '158');
INSERT INTO "public"."mm_category_product" VALUES ('10', '159');
INSERT INTO "public"."mm_category_product" VALUES ('10', '160');
INSERT INTO "public"."mm_category_product" VALUES ('10', '161');
INSERT INTO "public"."mm_category_product" VALUES ('10', '162');
INSERT INTO "public"."mm_category_product" VALUES ('10', '163');
INSERT INTO "public"."mm_category_product" VALUES ('10', '164');
INSERT INTO "public"."mm_category_product" VALUES ('10', '165');
INSERT INTO "public"."mm_category_product" VALUES ('10', '166');
INSERT INTO "public"."mm_category_product" VALUES ('10', '167');
INSERT INTO "public"."mm_category_product" VALUES ('10', '168');
INSERT INTO "public"."mm_category_product" VALUES ('10', '169');
INSERT INTO "public"."mm_category_product" VALUES ('10', '170');
INSERT INTO "public"."mm_category_product" VALUES ('10', '171');
INSERT INTO "public"."mm_category_product" VALUES ('10', '172');
INSERT INTO "public"."mm_category_product" VALUES ('10', '173');
INSERT INTO "public"."mm_category_product" VALUES ('10', '174');
INSERT INTO "public"."mm_category_product" VALUES ('10', '175');
INSERT INTO "public"."mm_category_product" VALUES ('10', '176');
INSERT INTO "public"."mm_category_product" VALUES ('10', '177');
INSERT INTO "public"."mm_category_product" VALUES ('10', '178');
INSERT INTO "public"."mm_category_product" VALUES ('10', '179');
INSERT INTO "public"."mm_category_product" VALUES ('10', '180');
INSERT INTO "public"."mm_category_product" VALUES ('10', '181');
INSERT INTO "public"."mm_category_product" VALUES ('10', '182');
INSERT INTO "public"."mm_category_product" VALUES ('10', '183');
INSERT INTO "public"."mm_category_product" VALUES ('10', '184');
INSERT INTO "public"."mm_category_product" VALUES ('10', '230');
INSERT INTO "public"."mm_category_product" VALUES ('11', '65');
INSERT INTO "public"."mm_category_product" VALUES ('11', '185');
INSERT INTO "public"."mm_category_product" VALUES ('11', '186');
INSERT INTO "public"."mm_category_product" VALUES ('11', '187');
INSERT INTO "public"."mm_category_product" VALUES ('11', '188');
INSERT INTO "public"."mm_category_product" VALUES ('11', '189');
INSERT INTO "public"."mm_category_product" VALUES ('11', '190');
INSERT INTO "public"."mm_category_product" VALUES ('11', '191');
INSERT INTO "public"."mm_category_product" VALUES ('11', '192');
INSERT INTO "public"."mm_category_product" VALUES ('11', '193');
INSERT INTO "public"."mm_category_product" VALUES ('11', '194');
INSERT INTO "public"."mm_category_product" VALUES ('11', '195');
INSERT INTO "public"."mm_category_product" VALUES ('11', '196');
INSERT INTO "public"."mm_category_product" VALUES ('11', '197');
INSERT INTO "public"."mm_category_product" VALUES ('11', '198');
INSERT INTO "public"."mm_category_product" VALUES ('11', '199');
INSERT INTO "public"."mm_category_product" VALUES ('11', '200');
INSERT INTO "public"."mm_category_product" VALUES ('11', '201');
INSERT INTO "public"."mm_category_product" VALUES ('11', '202');
INSERT INTO "public"."mm_category_product" VALUES ('11', '203');
INSERT INTO "public"."mm_category_product" VALUES ('11', '204');
INSERT INTO "public"."mm_category_product" VALUES ('11', '205');
INSERT INTO "public"."mm_category_product" VALUES ('11', '206');
INSERT INTO "public"."mm_category_product" VALUES ('11', '207');
INSERT INTO "public"."mm_category_product" VALUES ('11', '208');
INSERT INTO "public"."mm_category_product" VALUES ('11', '209');
INSERT INTO "public"."mm_category_product" VALUES ('11', '210');
INSERT INTO "public"."mm_category_product" VALUES ('11', '211');
INSERT INTO "public"."mm_category_product" VALUES ('11', '212');
INSERT INTO "public"."mm_category_product" VALUES ('11', '213');
INSERT INTO "public"."mm_category_product" VALUES ('11', '214');
INSERT INTO "public"."mm_category_product" VALUES ('11', '215');
INSERT INTO "public"."mm_category_product" VALUES ('11', '216');
INSERT INTO "public"."mm_category_product" VALUES ('11', '217');
INSERT INTO "public"."mm_category_product" VALUES ('11', '218');
INSERT INTO "public"."mm_category_product" VALUES ('11', '219');
INSERT INTO "public"."mm_category_product" VALUES ('11', '220');
INSERT INTO "public"."mm_category_product" VALUES ('11', '221');
INSERT INTO "public"."mm_category_product" VALUES ('11', '222');
INSERT INTO "public"."mm_category_product" VALUES ('11', '223');
INSERT INTO "public"."mm_category_product" VALUES ('11', '224');
INSERT INTO "public"."mm_category_product" VALUES ('11', '225');
INSERT INTO "public"."mm_category_product" VALUES ('11', '226');
INSERT INTO "public"."mm_category_product" VALUES ('11', '227');
INSERT INTO "public"."mm_category_product" VALUES ('11', '228');
INSERT INTO "public"."mm_category_product" VALUES ('11', '229');
INSERT INTO "public"."mm_category_product" VALUES ('11', '231');
INSERT INTO "public"."mm_category_product" VALUES ('11', '232');
INSERT INTO "public"."mm_category_product" VALUES ('11', '233');
INSERT INTO "public"."mm_category_product" VALUES ('11', '234');
INSERT INTO "public"."mm_category_product" VALUES ('11', '235');
INSERT INTO "public"."mm_category_product" VALUES ('11', '236');
INSERT INTO "public"."mm_category_product" VALUES ('11', '237');
INSERT INTO "public"."mm_category_product" VALUES ('11', '238');
INSERT INTO "public"."mm_category_product" VALUES ('11', '239');
INSERT INTO "public"."mm_category_product" VALUES ('11', '240');
INSERT INTO "public"."mm_category_product" VALUES ('11', '241');
INSERT INTO "public"."mm_category_product" VALUES ('11', '242');
INSERT INTO "public"."mm_category_product" VALUES ('11', '243');
INSERT INTO "public"."mm_category_product" VALUES ('11', '244');
INSERT INTO "public"."mm_category_product" VALUES ('11', '245');
INSERT INTO "public"."mm_category_product" VALUES ('11', '246');
INSERT INTO "public"."mm_category_product" VALUES ('11', '247');
INSERT INTO "public"."mm_category_product" VALUES ('11', '248');
INSERT INTO "public"."mm_category_product" VALUES ('11', '249');
INSERT INTO "public"."mm_category_product" VALUES ('11', '250');
INSERT INTO "public"."mm_category_product" VALUES ('11', '251');
INSERT INTO "public"."mm_category_product" VALUES ('11', '252');
INSERT INTO "public"."mm_category_product" VALUES ('11', '253');
INSERT INTO "public"."mm_category_product" VALUES ('11', '254');
INSERT INTO "public"."mm_category_product" VALUES ('11', '255');
INSERT INTO "public"."mm_category_product" VALUES ('11', '256');
INSERT INTO "public"."mm_category_product" VALUES ('11', '257');
INSERT INTO "public"."mm_category_product" VALUES ('11', '258');
INSERT INTO "public"."mm_category_product" VALUES ('11', '259');
INSERT INTO "public"."mm_category_product" VALUES ('11', '260');
INSERT INTO "public"."mm_category_product" VALUES ('11', '261');
INSERT INTO "public"."mm_category_product" VALUES ('11', '262');
INSERT INTO "public"."mm_category_product" VALUES ('11', '263');
INSERT INTO "public"."mm_category_product" VALUES ('11', '264');
INSERT INTO "public"."mm_category_product" VALUES ('11', '265');
INSERT INTO "public"."mm_category_product" VALUES ('11', '266');
INSERT INTO "public"."mm_category_product" VALUES ('11', '267');
INSERT INTO "public"."mm_category_product" VALUES ('11', '268');
INSERT INTO "public"."mm_category_product" VALUES ('11', '269');
INSERT INTO "public"."mm_category_product" VALUES ('11', '270');
INSERT INTO "public"."mm_category_product" VALUES ('11', '271');
INSERT INTO "public"."mm_category_product" VALUES ('11', '272');
INSERT INTO "public"."mm_category_product" VALUES ('11', '273');
INSERT INTO "public"."mm_category_product" VALUES ('11', '274');
INSERT INTO "public"."mm_category_product" VALUES ('11', '275');
INSERT INTO "public"."mm_category_product" VALUES ('11', '277');
INSERT INTO "public"."mm_category_product" VALUES ('11', '278');
INSERT INTO "public"."mm_category_product" VALUES ('11', '279');
INSERT INTO "public"."mm_category_product" VALUES ('11', '280');
INSERT INTO "public"."mm_category_product" VALUES ('11', '281');
INSERT INTO "public"."mm_category_product" VALUES ('11', '282');
INSERT INTO "public"."mm_category_product" VALUES ('11', '283');
INSERT INTO "public"."mm_category_product" VALUES ('11', '284');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS "public"."order";
CREATE TABLE "public"."order" (
"id" int4 DEFAULT nextval('order_id_seq'::regclass) NOT NULL,
"name" varchar COLLATE "default",
"phone" varchar COLLATE "default",
"email" varchar COLLATE "default",
"zipcode" varchar COLLATE "default",
"city" varchar COLLATE "default",
"street" varchar COLLATE "default",
"house" varchar COLLATE "default",
"build" varchar COLLATE "default",
"room" varchar COLLATE "default",
"delivery_type" "public"."delivery_type_list",
"user_id" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_product
-- ----------------------------
DROP TABLE IF EXISTS "public"."order_product";
CREATE TABLE "public"."order_product" (
"order_id" int4 NOT NULL,
"product_id" int4 NOT NULL,
"count" int4 NOT NULL,
"price" numeric NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of order_product
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS "public"."product";
CREATE TABLE "public"."product" (
"title" varchar(250) COLLATE "default",
"description" text COLLATE "default",
"price" numeric,
"sale" numeric,
"id" int4 DEFAULT nextval('products_id_seq1'::regclass) NOT NULL,
"count" int4,
"updated" timestamp(6) DEFAULT now(),
"visibility" bool DEFAULT true NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO "public"."product" VALUES ('Спиннинг 0', 'Описание для товара Спиннинг 0', '2688', '2419.2', '61', '18', '2017-04-25 20:02:21.893', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 1', 'Описание для товара Спиннинг 1', '4026', '3623.4', '62', '17', '2017-04-27 16:44:45.795', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 2', 'Описание для товара Спиннинг 2', '11756', '10580.4', '63', '5', '2017-05-05 18:02:22.75', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 3', 'Описание для товара Спиннинг 3', '7125', '6412.5', '64', '27', '2017-05-03 15:10:00.795', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 4', 'Описание для товара Спиннинг 4', '11939', '10745.1', '65', '22', '2017-05-03 20:53:22.459', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 5', 'Описание для товара Спиннинг 5', '9806', '8825.4', '66', '21', '2017-04-25 15:45:00.416', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 6', 'Описание для товара Спиннинг 6', '5994', '5394.6', '67', '12', '2017-05-10 13:09:11.075', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 7', 'Описание для товара Спиннинг 7', '11675', '10507.5', '68', '14', '2017-04-25 15:45:00.452', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 8', 'Описание для товара Спиннинг 8', '2977', '2679.3', '69', '11', '2017-04-25 15:45:00.465', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 10', 'Описание для товара Спиннинг 10', '5646', '5081.4', '71', '15', '2017-04-25 15:45:00.483', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 11', 'Описание для товара Спиннинг 11', '5101', '4590.9', '72', '20', '2017-04-25 15:45:00.493', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 12', 'Описание для товара Спиннинг 12', '10456', '9410.4', '73', '7', '2017-04-25 15:45:00.506', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 13', 'Описание для товара Спиннинг 13', '14772', '13294.8', '74', '26', '2017-04-25 15:45:00.515', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 16', 'Описание для товара Спиннинг 16', '6023', '5420.7', '77', '27', '2017-04-25 15:45:00.548', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 17', 'Описание для товара Спиннинг 17', '7656', '6890.4', '78', '15', '2017-05-05 18:15:20.344', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 18', 'Описание для товара Спиннинг 18', '8593', '7733.7', '79', '9', '2017-04-25 15:45:00.573', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 19', 'Описание для товара Спиннинг 19', '8983', '8084.7', '80', '16', '2017-04-25 15:45:00.582', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 20', 'Описание для товара Спиннинг 20', '11730', '10557', '81', '14', '2017-04-25 15:45:00.591', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 21', 'Описание для товара Спиннинг 21', '6742', '6067.8', '82', '20', '2017-04-25 15:45:00.6', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 22', 'Описание для товара Спиннинг 22', '5588', '5029.2', '83', '12', '2017-04-25 15:45:00.609', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 23', 'Описание для товара Спиннинг 23', '13140', '11826', '84', '18', '2017-04-25 15:45:00.623', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 24', 'Описание для товара Спиннинг 24', '11825', '10642.5', '85', '12', '2017-04-25 15:45:00.632', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 25', 'Описание для товара Спиннинг 25', '8880', '7992', '86', '11', '2017-04-25 15:45:00.64', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 26', 'Описание для товара Спиннинг 26', '7997', '7197.3', '87', '11', '2017-04-25 15:45:00.649', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 27', 'Описание для товара Спиннинг 27', '6172', '5554.8', '88', '14', '2017-04-25 15:45:00.658', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 28', 'Описание для товара Спиннинг 28', '3159', '2843.1', '89', '17', '2017-04-25 15:45:00.667', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 29', 'Описание для товара Спиннинг 29', '10920', '9828', '90', '5', '2017-04-25 15:45:00.681', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 30', 'Описание для товара Спиннинг 30', '12670', '11403', '91', '25', '2017-04-25 15:45:00.69', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 31', 'Описание для товара Спиннинг 31', '10131', '9117.9', '92', '24', '2017-04-25 15:45:00.699', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 32', 'Описание для товара Спиннинг 32', '7783', '7004.7', '93', '20', '2017-04-25 15:45:00.707', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 33', 'Описание для товара Спиннинг 33', '9711', '8739.9', '94', '22', '2017-04-25 15:45:00.717', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 34', 'Описание для товара Спиннинг 34', '3856', '3470.4', '95', '22', '2017-04-25 15:45:00.732', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 35', 'Описание для товара Спиннинг 35', '9266', '8339.4', '96', '15', '2017-04-25 15:45:00.74', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 36', 'Описание для товара Спиннинг 36', '9946', '8951.4', '97', '15', '2017-04-25 15:45:00.749', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 37', 'Описание для товара Спиннинг 37', '14704', '13233.6', '98', '30', '2017-04-25 15:45:00.759', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 38', 'Описание для товара Спиннинг 38', '3607', '3246.3', '99', '21', '2017-04-25 15:45:00.768', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 39', 'Описание для товара Спиннинг 39', '13029', '11726.1', '100', '6', '2017-04-25 15:45:00.781', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 40', 'Описание для товара Спиннинг 40', '6497', '5847.3', '101', '23', '2017-04-25 15:45:00.79', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 41', 'Описание для товара 123123123', '10148', '9133.2', '102', '23', '2017-04-25 19:34:40.565', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 42', 'Описание для товара Спиннинг 42', '8772', '7894.8', '103', '16', '2017-04-25 15:45:00.809', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 43', 'Описание для товара Спиннинг 43', '5667', '5100.3', '104', '18', '2017-04-25 15:45:00.821', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 44', 'Описание для товара Спиннинг 44', '6888', '6199.2', '105', '10', '2017-04-25 15:45:00.831', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 45', 'Описание для товара Спиннинг 45', '5493', '4943.7', '106', '19', '2017-04-25 15:45:00.857', 't');
INSERT INTO "public"."product" VALUES ('Спиннинг 46', 'Описание для товара Спиннинг 46', '3600', '3240', '107', '26', '2017-04-25 15:45:00.866', 't');
INSERT INTO "public"."product" VALUES ('Катушка 0', 'Описание для товара Катушка 0', '12219', '10997.1', '108', '17', '2017-04-25 15:45:00.877', 't');
INSERT INTO "public"."product" VALUES ('Катушка 1', 'Описание для товара Катушка 1', '10512', '9460.8', '109', '22', '2017-04-25 15:45:00.93', 't');
INSERT INTO "public"."product" VALUES ('Катушка 2', 'Описание для товара Катушка 2', '13512', '12160.8', '110', '13', '2017-04-25 15:45:00.942', 't');
INSERT INTO "public"."product" VALUES ('Катушка 3', 'Описание для товара Катушка 3', '13448', '12103.2', '111', '19', '2017-04-25 15:45:00.969', 't');
INSERT INTO "public"."product" VALUES ('Катушка 4', 'Описание для товара Катушка 4', '10521', '9468.9', '112', '23', '2017-04-25 15:45:00.986', 't');
INSERT INTO "public"."product" VALUES ('Катушка 5', 'Описание для товара Катушка 5', '8648', '7783.2', '113', '27', '2017-04-25 15:45:00.999', 't');
INSERT INTO "public"."product" VALUES ('Катушка 6', 'Описание для товара Катушка 6', '11216', '10094.4', '114', '23', '2017-04-25 15:45:01.009', 't');
INSERT INTO "public"."product" VALUES ('Катушка 7', 'Описание для товара Катушка 7', '16831', '15147.9', '115', '14', '2017-04-25 15:45:01.022', 't');
INSERT INTO "public"."product" VALUES ('Катушка 8', 'Описание для товара Катушка 8', '15066', '13559.4', '116', '30', '2017-04-25 15:45:01.031', 't');
INSERT INTO "public"."product" VALUES ('Катушка 9', 'Описание для товара Катушка 9', '16215', '14593.5', '117', '17', '2017-04-25 15:45:01.041', 't');
INSERT INTO "public"."product" VALUES ('Катушка 10', 'Описание для товара Катушка 10', '13038', '11734.2', '118', '18', '2017-04-25 15:45:01.056', 't');
INSERT INTO "public"."product" VALUES ('Катушка 11', 'Описание для товара Катушка 11', '10518', '9466.2', '119', '5', '2017-04-25 15:45:01.064', 't');
INSERT INTO "public"."product" VALUES ('Катушка 12', 'Описание для товара Катушка 12', '4602', '4141.8', '120', '5', '2017-04-25 15:45:01.074', 't');
INSERT INTO "public"."product" VALUES ('Катушка 13', 'Описание для товара Катушка 13', '11960', '10764', '121', '13', '2017-04-25 15:45:01.084', 't');
INSERT INTO "public"."product" VALUES ('Катушка 14', 'Описание для товара Катушка 14', '14728', '13255.2', '122', '17', '2017-04-25 15:45:01.098', 't');
INSERT INTO "public"."product" VALUES ('Катушка 15', 'Описание для товара Катушка 15', '7260', '6534', '123', '11', '2017-04-25 15:45:01.108', 't');
INSERT INTO "public"."product" VALUES ('Катушка 16', 'Описание для товара Катушка 16', '8881', '7992.9', '124', '19', '2017-04-25 15:45:01.122', 't');
INSERT INTO "public"."product" VALUES ('Катушка 17', 'Описание для товара Катушка 17', '8636', '7772.4', '125', '8', '2017-04-25 15:45:01.132', 't');
INSERT INTO "public"."product" VALUES ('Катушка 18', 'Описание для товара Катушка 18', '12034', '10830.6', '126', '14', '2017-04-25 15:45:01.141', 't');
INSERT INTO "public"."product" VALUES ('Катушка 19', 'Описание для товара Катушка 19', '19807', '17826.3', '127', '26', '2017-04-25 15:45:01.151', 't');
INSERT INTO "public"."product" VALUES ('Катушка 20', 'Описание для товара Катушка 20', '6653', '5987.7', '128', '15', '2017-04-25 15:45:01.164', 't');
INSERT INTO "public"."product" VALUES ('Катушка 21', 'Описание для товара Катушка 21', '18991', '17091.9', '129', '22', '2017-04-25 15:45:01.174', 't');
INSERT INTO "public"."product" VALUES ('Катушка 22', 'Описание для товара Катушка 22', '17708', '15937.2', '130', '27', '2017-04-25 15:45:01.184', 't');
INSERT INTO "public"."product" VALUES ('Катушка 23', 'Описание для товара Катушка 23', '9908', '8917.2', '131', '17', '2017-04-25 15:45:01.197', 't');
INSERT INTO "public"."product" VALUES ('Катушка 24', 'Описание для товара Катушка 24', '10666', '9599.4', '132', '11', '2017-04-25 15:45:01.208', 't');
INSERT INTO "public"."product" VALUES ('Катушка 25', 'Описание для товара Катушка 25', '4775', '4297.5', '133', '21', '2017-04-25 15:45:01.223', 't');
INSERT INTO "public"."product" VALUES ('Катушка 26', 'Описание для товара Катушка 26', '10498', '9448.2', '134', '24', '2017-04-25 15:45:01.232', 't');
INSERT INTO "public"."product" VALUES ('Катушка 27', 'Описание для товара Катушка 27', '7314', '6582.6', '135', '30', '2017-04-25 15:45:01.243', 't');
INSERT INTO "public"."product" VALUES ('Катушка 28', 'Описание для товара Катушка 28', '16672', '15004.8', '136', '28', '2017-04-25 15:45:01.253', 't');
INSERT INTO "public"."product" VALUES ('Катушка 29', 'Описание для товара Катушка 29', '12741', '11466.9', '137', '26', '2017-04-25 15:45:01.262', 't');
INSERT INTO "public"."product" VALUES ('Катушка 30', 'Описание для товара Катушка 30', '3156', '2840.4', '138', '25', '2017-04-25 15:45:01.281', 't');
INSERT INTO "public"."product" VALUES ('Катушка 31', 'Описание для товара Катушка 31', '7774', '6996.6', '139', '6', '2017-04-25 15:45:01.29', 't');
INSERT INTO "public"."product" VALUES ('Катушка 32', 'Описание для товара Катушка 32', '3419', '3077.1', '140', '6', '2017-04-25 15:45:01.299', 't');
INSERT INTO "public"."product" VALUES ('Катушка 33', 'Описание для товара Катушка 33', '4634', '4170.6', '141', '30', '2017-04-25 15:45:01.309', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 0', 'Описание для товара Плетеный шнур 0 12312313212 22131', '1299', '1169.1', '142', '24', '2017-04-25 19:15:05.803', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 1', 'Описание для товара Плетеный шнур 1', '1094', '984.6', '143', '17', '2017-04-25 15:45:01.342', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 2', 'Описание для товара Плетеный шнур 2', '2656', '2390.4', '144', '17', '2017-04-25 15:45:01.351', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 3', 'Описание для товара Плетеный шнур 3', '1560', '1404', '145', '27', '2017-04-25 15:45:01.361', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 4', 'Описание для товара Плетеный шнур 4', '805', '724.5', '146', '13', '2017-04-25 15:45:01.371', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 5', 'Описание для товара Плетеный шнур 5', '2686', '2417.4', '147', '30', '2017-04-25 15:45:01.38', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 6', 'Описание для товара Плетеный шнур 6', '667', '600.3', '148', '29', '2017-04-25 15:45:01.39', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 7', 'Описание для товара Плетеный шнур 7', '1266', '1139.4', '149', '9', '2017-04-25 15:45:01.399', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 8', 'Описание для товара Плетеный шнур 8', '916', '824.4', '150', '13', '2017-04-25 15:45:01.408', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 9', 'Описание для товара Плетеный шнур 9', '2851', '2565.9', '151', '13', '2017-04-25 15:45:01.417', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 10', 'Описание для товара Плетеный шнур 10', '1473', '1325.7', '152', '9', '2017-04-25 15:45:01.427', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 11', 'Описание для товара Плетеный шнур 11', '1735', '1561.5', '153', '23', '2017-04-25 15:45:01.436', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 12', 'Описание для товара Плетеный шнур 12', '1009', '908.1', '154', '17', '2017-04-25 15:45:01.446', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 13', 'Описание для товара Плетеный шнур 13', '965', '868.5', '155', '11', '2017-04-25 15:45:01.456', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 14', 'Описание для товара Плетеный шнур 14', '1946', '1751.4', '156', '28', '2017-04-25 15:45:01.465', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 15', 'Описание для товара Плетеный шнур 15', '2340', '2106', '157', '10', '2017-04-25 15:45:01.474', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 16', 'Описание для товара Плетеный шнур 16', '2957', '2661.3', '158', '18', '2017-04-25 15:45:01.483', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 17', 'Описание для товара Плетеный шнур 17', '1404', '1263.6', '159', '18', '2017-04-25 15:45:01.493', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 18', 'Описание для товара Плетеный шнур 18', '1462', '1315.8', '160', '29', '2017-04-25 15:45:01.502', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 19', 'Описание для товара Плетеный шнур 19', '2456', '2210.4', '161', '16', '2017-04-25 15:45:01.511', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 20', 'Описание для товара Плетеный шнур 20', '1134', '1020.6', '162', '10', '2017-04-25 15:45:01.539', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 21', 'Описание для товара Плетеный шнур 21', '1042', '937.8', '163', '26', '2017-04-25 15:45:01.548', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 22', 'Описание для товара Плетеный шнур 22', '1896', '1706.4', '164', '30', '2017-04-25 15:45:01.558', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 23', 'Описание для товара Плетеный шнур 23', '1459', '1313.1', '165', '7', '2017-04-25 15:45:01.568', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 24', 'Описание для товара Плетеный шнур 24', '2418', '2176.2', '166', '12', '2017-04-25 15:45:01.58', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 25', 'Описание для товара Плетеный шнур 25', '1755', '1579.5', '167', '5', '2017-04-25 15:45:01.589', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 26', 'Описание для товара Плетеный шнур 26', '2623', '2360.7', '168', '25', '2017-04-25 15:45:01.599', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 27', 'Описание для товара Плетеный шнур 27', '1224', '1101.6', '169', '30', '2017-05-04 17:52:26.644', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 28', 'Описание для товара Плетеный шнур 28', '1182', '1063.8', '170', '19', '2017-04-25 15:45:01.622', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 29', 'Описание для товара Плетеный шнур 29', '2916', '2624.4', '171', '25', '2017-04-25 15:45:01.631', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 30', 'Описание для товара Плетеный шнур 30', '517', '465.3', '172', '8', '2017-04-25 15:45:01.64', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 31', 'Описание для товара Плетеный шнур 31', '1126', '1013.4', '173', '26', '2017-04-25 15:45:01.65', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 32', 'Описание для товара Плетеный шнур 32', '1802', '1621.8', '174', '22', '2017-04-25 15:45:01.664', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 33', 'Описание для товара Плетеный шнур 33', '1402', '1261.8', '175', '28', '2017-04-25 15:45:01.673', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 34', 'Описание для товара Плетеный шнур 34', '2456', '2210.4', '176', '24', '2017-04-25 15:45:01.682', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 35', 'Описание для товара Плетеный шнур 35', '539', '485.1', '177', '14', '2017-04-25 15:45:01.697', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 36', 'Описание для товара Плетеный шнур 36', '1151', '1035.9', '178', '16', '2017-04-25 15:45:01.706', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 37', 'Описание для товара Плетеный шнур 37', '1587', '1428.3', '179', '7', '2017-04-25 15:45:01.715', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 38', 'Описание для товара Плетеный шнур 38', '2812', '2530.8', '180', '15', '2017-04-25 15:45:01.724', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 39', 'Описание для товара Плетеный шнур 39', '1340', '1206', '181', '14', '2017-04-25 15:45:01.734', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 40', 'Описание для товара Плетеный шнур 40', '1107', '996.3', '182', '21', '2017-04-25 15:45:01.747', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 41', 'Описание для товара Плетеный шнур 41', '2846', '2561.4', '183', '7', '2017-04-25 15:45:01.756', 't');
INSERT INTO "public"."product" VALUES ('Плетеный шнур 42', 'Описание для товара Плетеный шнур 42', '960', '864', '184', '25', '2017-04-25 15:45:01.766', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 0', 'Описание для товара Офсетные крючки 0', '293', '263.7', '185', '20', '2017-04-25 15:45:01.782', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 1', 'Описание для товара Офсетные крючки 1', '159', '143.1', '186', '30', '2017-04-25 15:45:01.791', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 2', 'Описание для товара Офсетные крючки 2', '232', '208.8', '187', '23', '2017-04-25 15:45:01.805', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 3', 'Описание для товара Офсетные крючки 3', '176', '158.4', '188', '24', '2017-04-25 15:45:01.815', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 4', 'Описание для товара Офсетные крючки 4', '235', '211.5', '189', '25', '2017-04-25 15:45:01.824', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 5', 'Описание для товара Офсетные крючки 5', '289', '260.1', '190', '10', '2017-04-25 15:45:01.839', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 6', 'Описание для товара Офсетные крючки 6', '162', '145.8', '191', '22', '2017-04-25 15:45:01.848', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 7', 'Описание для товара Офсетные крючки 7', '129', '116.1', '192', '29', '2017-04-25 15:45:01.858', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 8', 'Описание для товара Офсетные крючки 8', '142', '127.8', '193', '22', '2017-04-25 15:45:01.872', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 9', 'Описание для товара Офсетные крючки 9', '145', '130.5', '194', '7', '2017-04-25 15:45:01.881', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 10', 'Описание для товара Офсетные крючки 10', '215', '193.5', '195', '23', '2017-04-25 15:45:01.891', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 11', 'Описание для товара Офсетные крючки 11', '150', '135', '196', '9', '2017-04-25 15:45:01.905', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 12', 'Описание для товара Офсетные крючки 12', '149', '134.1', '197', '6', '2017-04-25 15:45:01.914', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 13', 'Описание для товара Офсетные крючки 13', '227', '204.3', '198', '14', '2017-04-25 15:45:01.923', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 14', 'Описание для товара Офсетные крючки 14', '165', '148.5', '199', '19', '2017-04-25 15:45:01.933', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 15', 'Описание для товара Офсетные крючки 15', '191', '171.9', '200', '9', '2017-04-25 15:45:01.947', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 16', 'Описание для товара Офсетные крючки 16', '211', '189.9', '201', '20', '2017-04-25 15:45:01.956', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 17', 'Описание для товара Офсетные крючки 17', '126', '113.4', '202', '25', '2017-04-25 15:45:01.965', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 18', 'Описание для товара Офсетные крючки 18', '147', '132.3', '203', '5', '2017-04-25 20:15:32.839', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 19', 'Описание для товара Офсетные крючки 19', '208', '187.2', '204', '23', '2017-04-25 15:45:01.989', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 20', 'Описание для товара Офсетные крючки 20', '283', '254.7', '205', '8', '2017-04-25 15:45:01.998', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 21', 'Описание для товара Офсетные крючки 21', '160', '144', '206', '7', '2017-04-25 15:45:02.007', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 22', 'Описание для товара Офсетные крючки 22', '298', '268.2', '207', '25', '2017-04-25 15:45:02.022', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 23', 'Описание для товара Офсетные крючки 23', '156', '140.4', '208', '18', '2017-04-25 15:45:02.031', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 24', 'Описание для товара Офсетные крючки 24', '139', '125.1', '209', '14', '2017-04-25 15:45:02.041', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 25', 'Описание для товара Офсетные крючки 25', '282', '253.8', '210', '6', '2017-04-25 15:45:02.055', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 26', 'Описание для товара Офсетные крючки 26', '209', '188.1', '211', '22', '2017-04-25 15:45:02.064', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 27', 'Описание для товара Офсетные крючки 27', '171', '153.9', '212', '14', '2017-04-25 15:45:02.074', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 28', 'Описание для товара Офсетные крючки 28', '276', '248.4', '213', '6', '2017-04-25 15:45:02.088', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 29', 'Описание для товара Офсетные крючки 29', '268', '241.2', '214', '16', '2017-04-25 15:45:02.099', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 30', 'Описание для товара Офсетные крючки 30', '198', '178.2', '215', '15', '2017-04-25 15:45:02.108', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 31', 'Описание для товара Офсетные крючки 31', '206', '185.4', '216', '29', '2017-04-25 15:45:02.117', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 32', 'Описание для товара Офсетные крючки 32', '287', '258.3', '217', '30', '2017-04-25 15:45:02.127', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 33', 'Описание для товара Офсетные крючки 33', '252', '226.8', '218', '30', '2017-04-25 15:45:02.14', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 34', 'Описание для товара Офсетные крючки 34', '220', '198', '219', '22', '2017-04-25 15:45:02.149', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 35', 'Описание для товара Офсетные крючки 35', '218', '196.2', '220', '6', '2017-04-25 15:45:02.158', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 36', 'Описание для товара Офсетные крючки 36', '128', '115.2', '221', '27', '2017-04-25 15:45:02.168', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 37', 'Описание для товара Офсетные крючки 37', '189', '170.1', '222', '14', '2017-04-25 15:45:02.182', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 38', 'Описание для товара Офсетные крючки 38', '230', '207', '223', '13', '2017-04-25 15:45:02.191', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 39', 'Описание для товара Офсетные крючки 39', '160', '144', '224', '17', '2017-04-25 15:45:02.2', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 40', 'Описание для товара Офсетные крючки 40', '294', '264.6', '225', '16', '2017-04-25 15:45:02.21', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 41', 'Описание для товара Офсетные крючки 41', '216', '194.4', '226', '16', '2017-04-25 15:45:02.223', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 42', 'Описание для товара Офсетные крючки 42', '181', '162.9', '227', '6', '2017-04-25 15:45:02.233', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 43', 'Описание для товара Офсетные крючки 43', '169', '152.1', '228', '28', '2017-04-25 15:45:02.243', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 44', 'Описание для товара Офсетные крючки 44', '200', '180', '229', '17', '2017-04-25 15:45:02.256', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 45', 'Описание для товара Офсетные крючки 45', '286', '257.4', '230', '28', '2017-04-25 20:08:01.218', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 46', 'Описание для товара Офсетные крючки 46', '210', '189', '231', '20', '2017-04-25 15:45:02.275', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 47', 'Описание для товара Офсетные крючки 47', '199', '179.1', '232', '7', '2017-04-25 15:45:02.29', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 48', 'Описание для товара Офсетные крючки 48', '160', '144', '233', '24', '2017-04-25 15:45:02.3', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 49', 'Описание для товара Офсетные крючки 49', '174', '156.6', '234', '18', '2017-04-25 15:45:02.309', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 50', 'Описание для товара Офсетные крючки 50', '271', '243.9', '235', '24', '2017-04-25 15:45:02.324', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 51', 'Описание для товара Офсетные крючки 51', '205', '184.5', '236', '25', '2017-04-25 15:45:02.333', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 52', 'Описание для товара Офсетные крючки 52', '130', '117', '237', '29', '2017-04-25 15:45:02.342', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 53', 'Описание для товара Офсетные крючки 53', '196', '176.4', '238', '5', '2017-04-25 15:45:02.357', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 54', 'Описание для товара Офсетные крючки 54', '139', '125.1', '239', '10', '2017-04-25 15:45:02.365', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 55', 'Описание для товара Офсетные крючки 55', '142', '127.8', '240', '25', '2017-04-25 15:45:02.375', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 56', 'Описание для товара Офсетные крючки 56', '246', '221.4', '241', '27', '2017-04-25 15:45:02.39', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 57', 'Описание для товара Офсетные крючки 57', '126', '113.4', '242', '9', '2017-04-25 15:45:02.399', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 58', 'Описание для товара Офсетные крючки 58', '130', '117', '243', '25', '2017-04-25 15:45:02.409', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 59', 'Описание для товара Офсетные крючки 59', '145', '130.5', '244', '26', '2017-04-25 15:45:02.423', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 60', 'Описание для товара Офсетные крючки 60', '281', '252.9', '245', '11', '2017-04-25 15:45:02.432', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 61', 'Описание для товара Офсетные крючки 61', '282', '253.8', '246', '24', '2017-04-25 15:45:02.442', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 62', 'Описание для товара Офсетные крючки 62', '198', '178.2', '247', '9', '2017-04-25 15:45:02.456', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 63', 'Описание для товара Офсетные крючки 63', '169', '152.1', '248', '20', '2017-04-25 15:45:02.465', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 64', 'Описание для товара Офсетные крючки 64', '191', '171.9', '249', '27', '2017-04-25 15:45:02.474', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 65', 'Описание для товара Офсетные крючки 65', '254', '228.6', '250', '16', '2017-04-25 15:45:02.484', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 66', 'Описание для товара Офсетные крючки 66', '299', '269.1', '251', '9', '2017-04-25 15:45:02.499', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 67', 'Описание для товара Офсетные крючки 67', '169', '152.1', '252', '28', '2017-04-25 15:45:02.508', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 68', 'Описание для товара Офсетные крючки 68', '291', '261.9', '253', '16', '2017-04-25 15:45:02.518', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 69', 'Описание для товара Офсетные крючки 69', '180', '162', '254', '6', '2017-04-25 15:45:02.531', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 70', 'Описание для товара Офсетные крючки 70', '207', '186.3', '255', '17', '2017-04-25 15:45:02.541', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 71', 'Описание для товара Офсетные крючки 71', '281', '252.9', '256', '17', '2017-04-25 15:45:02.551', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 72', 'Описание для товара Офсетные крючки 72', '175', '157.5', '257', '23', '2017-04-25 15:45:02.565', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 73', 'Описание для товара Офсетные крючки 73', '195', '175.5', '258', '13', '2017-04-25 15:45:02.574', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 74', 'Описание для товара Офсетные крючки 74', '237', '213.3', '259', '28', '2017-04-25 15:45:02.584', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 75', 'Описание для товара Офсетные крючки 75', '279', '251.1', '260', '7', '2017-04-25 15:45:02.598', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 76', 'Описание для товара Офсетные крючки 76', '160', '144', '261', '16', '2017-04-25 15:45:02.607', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 77', 'Описание для товара Офсетные крючки 77', '254', '228.6', '262', '29', '2017-04-25 15:45:02.617', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 78', 'Описание для товара Офсетные крючки 78', '164', '147.6', '263', '8', '2017-04-25 15:45:02.626', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 79', 'Описание для товара Офсетные крючки 79', '298', '268.2', '264', '17', '2017-04-25 15:45:02.642', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 80', 'Описание для товара Офсетные крючки 80', '199', '179.1', '265', '14', '2017-04-25 15:45:02.651', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 81', 'Описание для товара Офсетные крючки 81', '131', '117.9', '266', '24', '2017-04-25 15:45:02.665', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 82', 'Описание для товара Офсетные крючки 82', '124', '111.6', '267', '30', '2017-04-25 15:45:02.673', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 83', 'Описание для товара Офсетные крючки 83', '292', '262.8', '268', '15', '2017-04-25 15:45:02.683', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 84', 'Описание для товара Офсетные крючки 84', '249', '224.1', '269', '12', '2017-04-25 15:45:02.698', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 85', 'Описание для товара Офсетные крючки 85', '142', '127.8', '270', '16', '2017-04-25 15:45:02.708', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 86', 'Описание для товара Офсетные крючки 86', '252', '226.8', '271', '8', '2017-04-25 15:45:02.717', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 87', 'Описание для товара Офсетные крючки 87', '218', '196.2', '272', '19', '2017-04-25 15:45:02.731', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 88', 'Описание для товара Офсетные крючки 88', '263', '236.7', '273', '28', '2017-04-25 15:45:02.74', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 89', 'Описание для товара Офсетные крючки 89', '242', '217.8', '274', '25', '2017-04-25 15:45:02.749', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 90', 'Описание для товара Офсетные крючки 90', '141', '126.9', '275', '14', '2017-04-25 15:45:02.759', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 92', 'Описание для товара Офсетные крючки 92', '196', '176.4', '277', '29', '2017-04-25 15:45:02.782', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 93', 'Описание для товара Офсетные крючки 93', '205', '184.5', '278', '19', '2017-04-25 15:45:02.792', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 94', 'Описание для товара Офсетные крючки 94', '288', '259.2', '279', '17', '2017-04-25 15:45:02.807', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 95', 'Описание для товара Офсетные крючки 95', '222', '199.8', '280', '24', '2017-04-25 15:45:02.815', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 96', 'Описание для товара Офсетные крючки 96', '185', '166.5', '281', '11', '2017-04-25 15:45:02.825', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 97', 'Описание для товара Офсетные крючки 97', '166', '149.4', '282', '16', '2017-04-25 15:45:02.84', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 98', 'Описание для товара Офсетные крючки 98', '288', '259.2', '283', '8', '2017-04-25 15:45:02.848', 't');
INSERT INTO "public"."product" VALUES ('Офсетные крючки 99', 'Описание для товара Офсетные крючки 99', '211', '189.9', '284', '11', '2017-04-25 15:45:02.858', 't');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS "public"."user";
CREATE TABLE "public"."user" (
"id" int4 DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
"created" timestamptz(6) DEFAULT now() NOT NULL,
"lastname" varchar(200) COLLATE "default",
"firstname" varchar(200) COLLATE "default",
"middlename" varchar(200) COLLATE "default",
"login" varchar(200) COLLATE "default" NOT NULL,
"passwhash" varchar(500) COLLATE "default" NOT NULL,
"birthday" date,
"email" varchar(200) COLLATE "default" NOT NULL,
"emailtoken" varchar(200) COLLATE "default",
"isactive" bool DEFAULT false NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO "public"."user" VALUES ('33', '2017-04-03 19:42:35+03', 'user', 'user', 'user', 'user', '$2y$13$cMNE9YhiViJG25ICDkDLyeg5W7a9ZcrK1D.33B8XWbOoq.daPZqW.', '1981-01-01', 'user@uuuuuuuu.uu', null, 't');
INSERT INTO "public"."user" VALUES ('34', '2017-04-03 20:12:27+03', 'admin', 'admin', 'admin', 'admin', '$2y$13$DdvZlXj8ZUMR.8bWZc1yquDUEYHj9kmOa9lOfeUIWws6Qk4RYgvki', '1981-01-01', 'admin@aaaaaaaa.aa', '528b1f8fae857191bafee7ea0060bcc2', 't');
INSERT INTO "public"."user" VALUES ('40', '2017-04-13 19:04:39+03', 'user3', 'user3', 'user3', 'user3', '$2y$13$tYC34g36GW0Aog8BzxKjvO9kvPeWfQ3pZZfYCXxicuNQEU5gYoOQq', '1980-01-01', 'user3@@uuuuuuuu.uu', null, 't');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."categories_id_seq" OWNED BY "category"."id";
ALTER SEQUENCE "public"."categories_pos_seq" OWNED BY "category"."pos";
ALTER SEQUENCE "public"."images_id_seq" OWNED BY "image"."id";
ALTER SEQUENCE "public"."order_id_seq" OWNED BY "order"."id";
ALTER SEQUENCE "public"."products_id_seq1" OWNED BY "product"."id";
ALTER SEQUENCE "public"."users_id_seq" OWNED BY "user"."id";

-- ----------------------------
-- Primary Key structure for table auth_assignment
-- ----------------------------
ALTER TABLE "public"."auth_assignment" ADD PRIMARY KEY ("item_name", "user_id");

-- ----------------------------
-- Indexes structure for table auth_item
-- ----------------------------
CREATE INDEX "auth_item_type_idx" ON "public"."auth_item" USING btree (type);

-- ----------------------------
-- Primary Key structure for table auth_item
-- ----------------------------
ALTER TABLE "public"."auth_item" ADD PRIMARY KEY ("name");

-- ----------------------------
-- Primary Key structure for table auth_item_child
-- ----------------------------
ALTER TABLE "public"."auth_item_child" ADD PRIMARY KEY ("parent", "child");

-- ----------------------------
-- Primary Key structure for table auth_rule
-- ----------------------------
ALTER TABLE "public"."auth_rule" ADD PRIMARY KEY ("name");

-- ----------------------------
-- Primary Key structure for table category
-- ----------------------------
ALTER TABLE "public"."category" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table image
-- ----------------------------
ALTER TABLE "public"."image" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table mm_category_product
-- ----------------------------
CREATE INDEX "mm_category_product_category_id_product_id_idx" ON "public"."mm_category_product" USING btree (category_id, product_id);
CREATE INDEX "mm_category_product_product_id_category_id_idx" ON "public"."mm_category_product" USING btree (product_id, category_id);

-- ----------------------------
-- Primary Key structure for table mm_category_product
-- ----------------------------
ALTER TABLE "public"."mm_category_product" ADD PRIMARY KEY ("category_id", "product_id");

-- ----------------------------
-- Primary Key structure for table order
-- ----------------------------
ALTER TABLE "public"."order" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table order_product
-- ----------------------------
CREATE INDEX "order_product_product_id_order_id_idx" ON "public"."order_product" USING btree (product_id, order_id);

-- ----------------------------
-- Primary Key structure for table order_product
-- ----------------------------
ALTER TABLE "public"."order_product" ADD PRIMARY KEY ("order_id", "product_id");

-- ----------------------------
-- Triggers structure for table product
-- ----------------------------
CREATE TRIGGER "update_customer_modtime" BEFORE UPDATE ON "public"."product"
FOR EACH ROW
EXECUTE PROCEDURE "update_modified_column"();

-- ----------------------------
-- Primary Key structure for table product
-- ----------------------------
ALTER TABLE "public"."product" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table user
-- ----------------------------
ALTER TABLE "public"."user" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Foreign Key structure for table "public"."auth_assignment"
-- ----------------------------
ALTER TABLE "public"."auth_assignment" ADD FOREIGN KEY ("item_name") REFERENCES "public"."auth_item" ("name") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."auth_item"
-- ----------------------------
ALTER TABLE "public"."auth_item" ADD FOREIGN KEY ("rule_name") REFERENCES "public"."auth_rule" ("name") ON DELETE SET NULL ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."auth_item_child"
-- ----------------------------
ALTER TABLE "public"."auth_item_child" ADD FOREIGN KEY ("child") REFERENCES "public"."auth_item" ("name") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."auth_item_child" ADD FOREIGN KEY ("parent") REFERENCES "public"."auth_item" ("name") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."image"
-- ----------------------------
ALTER TABLE "public"."image" ADD FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE CASCADE ON UPDATE NO ACTION;

-- ----------------------------
-- Foreign Key structure for table "public"."mm_category_product"
-- ----------------------------
ALTER TABLE "public"."mm_category_product" ADD FOREIGN KEY ("category_id") REFERENCES "public"."category" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE "public"."mm_category_product" ADD FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."order"
-- ----------------------------
ALTER TABLE "public"."order" ADD FOREIGN KEY ("user_id") REFERENCES "public"."user" ("id") ON DELETE SET NULL ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Key structure for table "public"."order_product"
-- ----------------------------
ALTER TABLE "public"."order_product" ADD FOREIGN KEY ("order_id") REFERENCES "public"."order" ("id") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."order_product" ADD FOREIGN KEY ("product_id") REFERENCES "public"."product" ("id") ON DELETE RESTRICT ON UPDATE RESTRICT;
