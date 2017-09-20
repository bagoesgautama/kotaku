-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Table `bkt_01010101_prop`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_01010101_prop` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(45) NOT NULL,
  `nama_pendek` VARCHAR(45) NULL,
  `wilayah` VARCHAR(45) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_01010102_kota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_01010102_kota` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(45) NOT NULL,
  `nama_pendek` VARCHAR(45) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_prop` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  INDEX `fk_m_kota_1_idx` (`kode_prop` ASC),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  CONSTRAINT `fk_m_kota_1`
    FOREIGN KEY (`kode_prop`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_01010103_kec`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_01010103_kec` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(45) NOT NULL,
  `nama_pendek` VARCHAR(45) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_kota` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  INDEX `fk_m_kec_1_idx` (`kode_kota` ASC),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  CONSTRAINT `fk_m_kec_1`
    FOREIGN KEY (`kode_kota`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_01010104_kel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_01010104_kel` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `keterangan` VARCHAR(300) NULL,
  `kode_bps` VARCHAR(45) NULL,
  `stat_kode_bps` VARCHAR(45) NULL,
  `kode_kec` INT(11) NOT NULL,
  `status` VARCHAR(45) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_m_kel_1_idx` (`kode_kec` ASC),
  CONSTRAINT `fk_m_kel_1`
    FOREIGN KEY (`kode_kec`)
    REFERENCES `bkt_01010103_kec` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_01010105_table_ref`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_01010105_table_ref` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama_table` VARCHAR(50) NOT NULL,
  `nama_kolom` VARCHAR(50) NOT NULL,
  `nilai` VARCHAR(50) NOT NULL,
  `nama` VARCHAR(50) NOT NULL,
  `keterangan` VARCHAR(50) NULL,
  `created_time` TIMESTAMP NOT NULL DEFAULT now(),
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010101_role_level`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010101_role_level` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010102_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010102_role` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_level` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02010101_role_1_idx` (`kode_level` ASC),
  CONSTRAINT `fk_bkt_02010101_role_1`
    FOREIGN KEY (`kode_level`)
    REFERENCES `bkt_02010101_role_level` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02020201_registrasi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02020201_registrasi` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `nama_depan` VARCHAR(50) NOT NULL,
  `nama_belakang` VARCHAR(50) NOT NULL,
  `kode_level` INT(11) NULL,
  `kode_role` INT(11) NULL,
  `wk_kd_prop` INT(11) NULL,
  `wk_kd_kota` INT(11) NULL,
  `wk_kd_kel` INT(11) NULL,
  `alamat` VARCHAR(50) NULL,
  `kode_prop` INT(11) NULL,
  `kode_kota` INT(11) NULL,
  `kode_kec` INT(11) NULL,
  `kode_kel` INT(11) NULL,
  `kodepos` VARCHAR(5) NULL,
  `kode_jenis_kelamin` VARCHAR(1) NOT NULL COMMENT 'P: Pria\nW: Wanita',
  `kode_tempat_lahir` INT(11) NULL,
  `tgl_lahir` DATE NULL,
  `email` VARCHAR(255) NOT NULL,
  `no_hp` VARCHAR(50) NULL,
  `no_hp2` VARCHAR(50) NULL,
  `jenis_registrasi` VARCHAR(1) NULL COMMENT '0: Mandiri\n1: Manual',
  `status_registrasi` VARCHAR(1) NOT NULL DEFAULT 0 COMMENT '0: Belum Diverifikasi\n1: Registrasi Berhasil\n2: Registrasi Ditolak',
  `validated_by` INT(11) NULL,
  `validated_time` DATETIME NULL,
  `validation_note` VARCHAR(300) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02020201_registrasi_1_idx` (`kode_prop` ASC),
  INDEX `fk_bkt_02020201_registrasi_2_idx` (`kode_kota` ASC),
  INDEX `fk_bkt_02020201_registrasi_3_idx` (`kode_kec` ASC),
  INDEX `fk_bkt_02020201_registrasi_4_idx` (`kode_kel` ASC),
  INDEX `fk_bkt_02020201_registrasi_5_idx` (`kode_level` ASC),
  INDEX `fk_bkt_02020201_registrasi_6_idx` (`kode_role` ASC),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  INDEX `fk_bkt_02020201_registrasi_7_idx` (`kode_tempat_lahir` ASC),
  INDEX `fk_bkt_02020201_registrasi_8_idx` (`wk_kd_prop` ASC),
  INDEX `fk_bkt_02020201_registrasi_9_idx` (`wk_kd_kota` ASC),
  INDEX `fk_bkt_02020201_registrasi_10_idx` (`wk_kd_kel` ASC),
  CONSTRAINT `fk_bkt_02020201_registrasi_1`
    FOREIGN KEY (`kode_prop`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_2`
    FOREIGN KEY (`kode_kota`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_3`
    FOREIGN KEY (`kode_kec`)
    REFERENCES `bkt_01010103_kec` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_4`
    FOREIGN KEY (`kode_kel`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_5`
    FOREIGN KEY (`kode_level`)
    REFERENCES `bkt_02010101_role_level` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_6`
    FOREIGN KEY (`kode_role`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_7`
    FOREIGN KEY (`kode_tempat_lahir`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_8`
    FOREIGN KEY (`wk_kd_prop`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_9`
    FOREIGN KEY (`wk_kd_kota`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02020201_registrasi_10`
    FOREIGN KEY (`wk_kd_kel`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010103_apps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010103_apps` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010104_modul`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010104_modul` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_apps` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02010104_module_1_idx` (`kode_apps` ASC),
  CONSTRAINT `fk_bkt_02010104_module_1`
    FOREIGN KEY (`kode_apps`)
    REFERENCES `bkt_02010103_apps` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010106_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010106_menu` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_parent` INT(11) NULL,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_modul` INT(11) NOT NULL,
  `no_urut` SMALLINT(5) NULL,
  `url` VARCHAR(50) NULL,
  `state` VARCHAR(50) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02010106_menu_1_idx` (`kode_modul` ASC),
  INDEX `fk_bkt_02010106_menu_2_idx` (`kode_parent` ASC),
  CONSTRAINT `fk_bkt_02010106_menu_1`
    FOREIGN KEY (`kode_modul`)
    REFERENCES `bkt_02010104_modul` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010106_menu_2`
    FOREIGN KEY (`kode_parent`)
    REFERENCES `bkt_02010106_menu` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010107_akses_role`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010107_akses_role` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_role` INT(11) NOT NULL,
  `kode_menu` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  UNIQUE INDEX `idx_role_menu_un` (`kode_role` ASC, `kode_menu` ASC),
  INDEX `fk_bkt_02010107_akses_role_2_idx` (`kode_menu` ASC),
  CONSTRAINT `fk_bkt_02010107_akses_role_1`
    FOREIGN KEY (`kode_role`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010107_akses_role_2`
    FOREIGN KEY (`kode_menu`)
    REFERENCES `bkt_02010106_menu` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010108_menu_detil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010108_menu_detil` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NOT NULL DEFAULT '1' COMMENT '0: Tidak Aktif\n1: Aktif\n2: Dihapus',
  `kode_menu` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  INDEX `fk_bkt_02010108_menu_detil_1_idx` (`kode_menu` ASC),
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  CONSTRAINT `fk_bkt_02010108_menu_detil_1`
    FOREIGN KEY (`kode_menu`)
    REFERENCES `bkt_02010106_menu` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010109_akses_role_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010109_akses_role_detail` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_role` INT(11) NOT NULL,
  `kode_menu` INT(11) NOT NULL,
  `kode_menu_detil` INT(11) NOT NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02010109_akses_role_detail_1_idx` (`kode_role` ASC),
  INDEX `fk_bkt_02010109_akses_role_detail_2_idx` (`kode_menu` ASC),
  INDEX `fk_bkt_02010109_akses_role_detail_3_idx` (`kode_menu_detil` ASC),
  CONSTRAINT `fk_bkt_02010109_akses_role_detail_1`
    FOREIGN KEY (`kode_role`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010109_akses_role_detail_2`
    FOREIGN KEY (`kode_menu`)
    REFERENCES `bkt_02010106_menu` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010109_akses_role_detail_3`
    FOREIGN KEY (`kode_menu_detil`)
    REFERENCES `bkt_02010108_menu_detil` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010110_pendidikan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010110_pendidikan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010111_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010111_user` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `nama_depan` VARCHAR(50) NOT NULL,
  `nama_belakang` VARCHAR(50) NULL,
  `kode_level` INT(11) NULL,
  `kode_role` INT(11) NULL,
  `wk_kd_prop` INT(11) NULL,
  `wk_kd_kota` INT(11) NULL,
  `wk_kd_kel` INT(11) NULL,
  `alamat` VARCHAR(50) NULL,
  `kode_jenis_kelamin` VARCHAR(1) NOT NULL COMMENT 'P: Pria\nW: Wanita',
  `kode_kota_lahir` INT(11) NULL,
  `tgl_lahir` DATE NULL,
  `kode_pendidikan_terakhir` INT(11) NULL,
  `bidang_studi` VARCHAR(50) NULL,
  `kode_prop` INT(11) NULL,
  `kode_kota` INT(11) NULL,
  `kode_kec` INT(11) NULL,
  `kode_kel` INT(11) NULL,
  `kodepos` VARCHAR(5) NULL,
  `email` VARCHAR(255) NOT NULL,
  `no_hp` VARCHAR(50) NULL,
  `no_hp2` VARCHAR(50) NULL,
  `jenis_registrasi` VARCHAR(1) NULL COMMENT '0: Mandiri\n1: Manual',
  `status_registrasi` VARCHAR(1) NOT NULL DEFAULT 0 COMMENT '0: Belum Diverifikasi\n1: Registrasi Berhasil\n2: Registrasi Ditolak',
  `validated_by` INT(11) NULL,
  `validated_time` DATETIME NULL,
  `validation_note` VARCHAR(300) NULL,
  `status_aktif` VARCHAR(1) NOT NULL DEFAULT 0 COMMENT '0: Tidak Aktif\n1: Aktif Kontrak\n2: Aktif Permanen\n3: Diberhentikan',
  `tgl_akhir_kontrak` DATE NULL,
  `tgl_aktivasi` DATETIME NULL,
  `flag_blacklist` BIT(1) NOT NULL DEFAULT 0,
  `blacklist_dt` DATETIME NULL,
  `blacklist_by` INT(11) NULL,
  `blacklist_notes` VARCHAR(300) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02010111_user_1_idx` (`kode_prop` ASC),
  INDEX `fk_bkt_02010111_user_2_idx` (`kode_kota` ASC),
  INDEX `fk_bkt_02010111_user_3_idx` (`kode_kec` ASC),
  INDEX `fk_bkt_02010111_user_4_idx` (`kode_kel` ASC),
  INDEX `fk_bkt_02010111_user_5_idx` (`kode_level` ASC),
  INDEX `fk_bkt_02010111_user_6_idx` (`kode_role` ASC),
  UNIQUE INDEX `user_name_UNIQUE` (`user_name` ASC),
  INDEX `fk_bkt_02010111_user_7_idx` (`kode_kota_lahir` ASC),
  INDEX `fk_bkt_02010111_user_8_idx` (`kode_pendidikan_terakhir` ASC),
  INDEX `fk_bkt_02010111_user_9_idx` (`wk_kd_prop` ASC),
  INDEX `fk_bkt_02010111_user_10_idx` (`wk_kd_kota` ASC),
  INDEX `fk_bkt_02010111_user_11_idx` (`wk_kd_kel` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  CONSTRAINT `fk_bkt_02010111_user_1`
    FOREIGN KEY (`kode_prop`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_2`
    FOREIGN KEY (`kode_kota`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_3`
    FOREIGN KEY (`kode_kec`)
    REFERENCES `bkt_01010103_kec` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_4`
    FOREIGN KEY (`kode_kel`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_5`
    FOREIGN KEY (`kode_level`)
    REFERENCES `bkt_02010101_role_level` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_6`
    FOREIGN KEY (`kode_role`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_7`
    FOREIGN KEY (`kode_kota_lahir`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_8`
    FOREIGN KEY (`kode_pendidikan_terakhir`)
    REFERENCES `bkt_02010110_pendidikan` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_9`
    FOREIGN KEY (`wk_kd_prop`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_10`
    FOREIGN KEY (`wk_kd_kota`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02010111_user_11`
    FOREIGN KEY (`wk_kd_kel`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030201_log_aktivitas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030201_log_aktivitas` (
  `bkt_02030201_log_aktivitas` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NOT NULL,
  `kode_apps` INT(11) NOT NULL,
  `kode_modul` INT(11) NOT NULL,
  `kode_menu` INT(11) NOT NULL,
  `kode_menu_detil` INT(11) NULL,
  `aktifitas` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  PRIMARY KEY (`bkt_02030201_log_aktivitas`),
  UNIQUE INDEX `bkt_02030201_log_aktivitas_UNIQUE` (`bkt_02030201_log_aktivitas` ASC),
  INDEX `fk_bkt_02030201_log_aktivitas_1_idx` (`kode_user` ASC),
  INDEX `fk_bkt_02030201_log_aktivitas_2_idx` (`kode_apps` ASC),
  INDEX `fk_bkt_02030201_log_aktivitas_3_idx` (`kode_modul` ASC),
  INDEX `fk_bkt_02030201_log_aktivitas_4_idx` (`kode_menu` ASC),
  INDEX `fk_bkt_02030201_log_aktivitas_5_idx` (`kode_menu_detil` ASC),
  CONSTRAINT `fk_bkt_02030201_log_aktivitas_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030201_log_aktivitas_2`
    FOREIGN KEY (`kode_apps`)
    REFERENCES `bkt_02010103_apps` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030201_log_aktivitas_3`
    FOREIGN KEY (`kode_modul`)
    REFERENCES `bkt_02010104_modul` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030201_log_aktivitas_4`
    FOREIGN KEY (`kode_menu`)
    REFERENCES `bkt_02010106_menu` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030201_log_aktivitas_5`
    FOREIGN KEY (`kode_menu_detil`)
    REFERENCES `bkt_02010108_menu_detil` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030202_pelatihan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030202_pelatihan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NULL,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `tgl_pelatihan` DATE NULL,
  `instansi` VARCHAR(50) NULL,
  `uri_img_sertifikat1` VARCHAR(100) NULL,
  `uri_img_sertifikat2` VARCHAR(100) NULL,
  `url_img_sertifikat3` VARCHAR(100) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02030202_pelatihan_1_idx` (`kode_user` ASC),
  CONSTRAINT `fk_bkt_02030202_pelatihan_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030203_penghargaan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030203_penghargaan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NULL,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `tgl_penghargaan` DATE NULL,
  `instansi` VARCHAR(50) NULL,
  `uri_img_sertifikat1` VARCHAR(100) NULL,
  `uri_img_sertifikat2` VARCHAR(100) NULL,
  `url_img_sertifikat3` VARCHAR(100) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02030203_penghargaan_1_idx` (`kode_user` ASC),
  CONSTRAINT `fk_bkt_02030203_penghargaan_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02010111_jns_perubahan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02010111_jns_perubahan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(50) NOT NULL,
  `deskripsi` VARCHAR(300) NULL,
  `status` VARCHAR(1) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030204_perubahan_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030204_perubahan_status` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NOT NULL,
  `kode_jns_perubahan` INT(11) NOT NULL,
  `kode_role_lama` INT(11) NOT NULL,
  `kode_role_baru` INT(11) NOT NULL,
  `tgl_efektif_role_baru` DATE NOT NULL,
  `catatan` VARCHAR(300) NULL,
  `uri_img_sk1` VARCHAR(100) NULL,
  `uri_img_sk2` VARCHAR(100) NULL,
  `uri_img_sk3` VARCHAR(100) NULL,
  `divalidasi_oleh` INT(11) NULL,
  `validasi_dt` DATETIME NULL,
  `catatan_validasi` VARCHAR(300) NULL,
  `kode_prop_lama` INT(11) NULL,
  `kode_prop_baru` INT(11) NULL,
  `kode_kota_lama` INT(11) NULL,
  `kode_kota_baru` INT(11) NULL,
  `kode_kel_lama` INT(11) NULL,
  `kode_kel_baru` INT(11) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_1_idx` (`kode_user` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_2_idx` (`kode_jns_perubahan` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_3_idx` (`kode_role_lama` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_5_idx` (`kode_prop_lama` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_6_idx` (`kode_prop_baru` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_7_idx` (`kode_kota_lama` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_8_idx` (`kode_kota_baru` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_9_idx` (`kode_kel_lama` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_10_idx` (`kode_kel_baru` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_11_idx` (`divalidasi_oleh` ASC),
  INDEX `fk_bkt_02030204_perubahan_status_4_idx` (`kode_role_baru` ASC),
  CONSTRAINT `fk_bkt_02030204_perubahan_status_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_2`
    FOREIGN KEY (`kode_jns_perubahan`)
    REFERENCES `bkt_02010111_jns_perubahan` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_3`
    FOREIGN KEY (`kode_role_lama`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_4`
    FOREIGN KEY (`kode_role_baru`)
    REFERENCES `bkt_02010102_role` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_5`
    FOREIGN KEY (`kode_prop_lama`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_6`
    FOREIGN KEY (`kode_prop_baru`)
    REFERENCES `bkt_01010101_prop` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_7`
    FOREIGN KEY (`kode_kota_lama`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_8`
    FOREIGN KEY (`kode_kota_baru`)
    REFERENCES `bkt_01010102_kota` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_9`
    FOREIGN KEY (`kode_kel_lama`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_10`
    FOREIGN KEY (`kode_kel_baru`)
    REFERENCES `bkt_01010104_kel` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030204_perubahan_status_11`
    FOREIGN KEY (`divalidasi_oleh`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030205_pesan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030205_pesan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NOT NULL,
  `text_pesan` VARCHAR(300) NOT NULL,
  `status` VARCHAR(1) NULL COMMENT '0: Belum Dibaca\n1: Sudah Dibaca\n2: Ditandai\n3: Sudah Dihapus',
  `tgl_pesan_masuk` DATETIME NOT NULL DEFAULT now(),
  `tgl_pesan_dibaca` DATETIME NULL,
  `tgl_pesan_dihapus` DATETIME NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02030204_pesan_1_idx` (`kode_user` ASC),
  CONSTRAINT `fk_bkt_02030204_pesan_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bkt_02030206_peringatan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bkt_02030206_peringatan` (
  `kode` INT(11) NOT NULL AUTO_INCREMENT,
  `kode_user` INT(11) NOT NULL,
  `counter_peringatan` INT(3) NOT NULL,
  `catatan_peringatan` VARCHAR(300) NULL,
  `uri_img_sp1` VARCHAR(100) NULL,
  `uri_img_sp2` VARCHAR(100) NULL,
  `uri_img_sp3` VARCHAR(100) NULL,
  `tgl_peringatan` DATE NULL,
  `diverifikasi_oleh` INT(11) NULL,
  `tgl_verifikasi` DATETIME NULL,
  `catatan_verifikasi` VARCHAR(300) NULL,
  `created_time` DATETIME NOT NULL DEFAULT now(),
  `created_by` INT(11) NULL,
  `updated_time` DATETIME NULL,
  `updated_by` INT(11) NULL,
  PRIMARY KEY (`kode`),
  UNIQUE INDEX `kode_UNIQUE` (`kode` ASC),
  INDEX `fk_bkt_02030206_peringatan_1_idx` (`kode_user` ASC),
  INDEX `fk_bkt_02030206_peringatan_2_idx` (`diverifikasi_oleh` ASC),
  CONSTRAINT `fk_bkt_02030206_peringatan_1`
    FOREIGN KEY (`kode_user`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bkt_02030206_peringatan_2`
    FOREIGN KEY (`diverifikasi_oleh`)
    REFERENCES `bkt_02010111_user` (`kode`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
