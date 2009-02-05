
CREATE TABLE "prefix__settings" (
  "id" int(11) NOT NULL,
  "key" varchar(255) NOT NULL,
  "value" text NOT NULL,
  "description" text NOT NULL,
  "created" datetime NOT NULL,
  "modified" datetime NOT NULL,
  PRIMARY KEY  ("id"),
  KEY "key" ("key")
);