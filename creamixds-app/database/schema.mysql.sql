-- Esquema para MySQL / MariaDB

CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(120) NOT NULL,
  email         VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          VARCHAR(30)  NOT NULL DEFAULT 'admin',
  created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS settings (
  id       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  key_name VARCHAR(80)  NOT NULL UNIQUE,
  value    TEXT         NULL,
  label    VARCHAR(160) NOT NULL,
  position INT          NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS content_blocks (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  type        VARCHAR(40)  NOT NULL,
  icon        VARCHAR(80)  NULL,
  title       VARCHAR(190) NOT NULL,
  description TEXT         NULL,
  position    INT          NOT NULL DEFAULT 0,
  is_active   TINYINT(1)   NOT NULL DEFAULT 1,
  INDEX idx_type_position (type, position)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS projects (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  emoji       VARCHAR(16)  NULL,
  tag         VARCHAR(60)  NULL,
  title       VARCHAR(190) NOT NULL,
  description TEXT         NULL,
  url         VARCHAR(255) NULL,
  position    INT          NOT NULL DEFAULT 0,
  is_active   TINYINT(1)   NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS testimonials (
  id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  avatar    VARCHAR(16)  NULL,
  quote     TEXT         NOT NULL,
  author    VARCHAR(120) NOT NULL,
  role      VARCHAR(160) NULL,
  position  INT          NOT NULL DEFAULT 0,
  is_active TINYINT(1)   NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS leads (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(120) NOT NULL,
  email      VARCHAR(190) NOT NULL,
  company    VARCHAR(160) NULL,
  service    VARCHAR(80)  NULL,
  message    TEXT         NOT NULL,
  ip         VARCHAR(45)  NULL,
  user_agent VARCHAR(255) NULL,
  status     VARCHAR(20)  NOT NULL DEFAULT 'nuevo',
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_status_created (status, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
