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

Date: 2017-04-12 16:19:40
*/


-- ----------------------------
-- Sequence structure for categories_id_seq
-- ----------------------------
DROP SEQUENCE "public"."categories_id_seq";
CREATE SEQUENCE "public"."categories_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for categories_pos_seq
-- ----------------------------
DROP SEQUENCE "public"."categories_pos_seq";
CREATE SEQUENCE "public"."categories_pos_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for images_id_seq
-- ----------------------------
DROP SEQUENCE "public"."images_id_seq";
CREATE SEQUENCE "public"."images_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

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
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for users_id_seq
-- ----------------------------
DROP SEQUENCE "public"."users_id_seq";
CREATE SEQUENCE "public"."users_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 37
 CACHE 1;
SELECT setval('"public"."users_id_seq"', 37, true);

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
"count" int4
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of product
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS "public"."user";
CREATE TABLE "public"."user" (
"id" int4 DEFAULT nextval('users_id_seq'::regclass) NOT NULL,
"created" timestamptz(6) NOT NULL,
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
INSERT INTO "public"."user" VALUES ('34', '2017-04-03 20:12:27+03', 'admin', 'admin', 'admin', 'admin', '$2y$13$Yux.vWDBzdOV.Cyqh1RsweB/I0NJjaxzFHQdYCATgJVPLif8FOzvy', '1981-01-01', 'admin@aaaaaaaa.aa', null, 't');

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
