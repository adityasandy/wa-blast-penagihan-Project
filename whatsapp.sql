/*
 Navicat Premium Data Transfer

 Source Server         : ITHD
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : whatsapp

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 02/11/2020 08:58:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_wa
-- ----------------------------
DROP TABLE IF EXISTS `data_wa`;
CREATE TABLE `data_wa`  (
  `ID_MSG` bigint(255) NOT NULL AUTO_INCREMENT,
  `NO_WA` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '',
  `FORMAT_WA` varchar(900) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ISI_WA` varchar(900) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `TGL_INPUT` datetime(0) NULL DEFAULT NULL,
  `TGL_KIRIM` datetime(0) NULL DEFAULT NULL,
  `STATUS` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_1` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_2` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_3` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_4` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_5` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_6` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_7` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_8` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_9` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `VAR_10` varchar(300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID_MSG`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2147483871 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_wa
-- ----------------------------
INSERT INTO `data_wa` VALUES (2147483842, '+628113975323', 'coba coba', 'coba coba', '2020-10-21 18:40:04', '2020-10-21 18:41:10', 'SENT', 'ADITYA NOOR SANDY', 'jl. Semarapura no. 27', 'RP. 250.000,-', '4 bulan', '', '', '', '', '', '');
INSERT INTO `data_wa` VALUES (2147483845, '+628113975323', 'cek coba', 'cek coba', '2020-10-21 18:59:51', '2020-10-21 19:00:17', 'SENT', 'ADITYA NOOR SANDY', 'jl. Semarapura no. 27', 'RP. 250.000,-', '4 bulan', '', '', '', '', '', '');
INSERT INTO `data_wa` VALUES (2147483869, '+628113975323', 'Selamat Sore Bapak/Ibu Keluarga [VAR_1],kami dari BPJS Kesehatan Kantor Cabang Klungkung bermaksud menyampaikan informasi bahwa nomor kartu JKN-KIS Keluarga  [VAR_2], memiliki tunggakan sebesar [VAR_3] * (tunggakan [VAR_4] dengan jumlah anggota keluarga [VAR_5] ).Segera lakukan pembayaran di kanal pembayaran iuran BPJS Kesehatan (Bank Mandiri, BNI, BTN, BRI, BCA, Indomaret, Tokopedia, Alfamart, PT Pos dan lain-lain). *Abaikan pesan ini jika sudah membayar*. Informasi kepesertaan dan rincian tagihan dapat dilihat melalui aplikasi Mobile JKN, yang dapat diunduh melalui Google Playstore atau AppStore. Demi kenyamanan Anda, segera daftarkan pembayaran iuran BPJS Kesehatan Anda melalui layanan autodebit di Bank Mandiri, BNI, BRI, BCA atau melalui aplikasi Mobile JKN. Untuk informasi lebih lanjut dapat menghubungi Call Center BPJS Kesehatan 1500400 (24 jam), atau layanan melalui Whatsapp ke no', 'Selamat Sore Bapak/Ibu Keluarga ADITYA NOOR SANDY,kami dari BPJS Kesehatan Kantor Cabang Klungkung bermaksud menyampaikan informasi bahwa nomor kartu JKN-KIS Keluarga  jl. Semarapura no. 27, memiliki tunggakan sebesar RP. 250.000,- * (tunggakan 4 bulan dengan jumlah anggota keluarga  ).Segera lakukan pembayaran di kanal pembayaran iuran BPJS Kesehatan (Bank Mandiri, BNI, BTN, BRI, BCA, Indomaret, Tokopedia, Alfamart, PT Pos dan lain-lain). *Abaikan pesan ini jika sudah membayar*. Informasi kepesertaan dan rincian tagihan dapat dilihat melalui aplikasi Mobile JKN, yang dapat diunduh melalui Google Playstore atau AppStore. Demi kenyamanan Anda, segera daftarkan pembayaran iuran BPJS Kesehatan Anda melalui layanan autodebit di Bank Mandiri, BNI, BRI, BCA atau melalui aplikasi Mobile JKN. Untuk informasi lebih lanjut dapat menghubungi Call Center BPJS Kesehatan 1500400 (24 jam), atau layanan', '2020-10-22 12:16:39', NULL, NULL, 'ADITYA NOOR SANDY', 'jl. Semarapura no. 27', 'RP. 250.000,-', '4 bulan', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `is_active` int(1) NULL DEFAULT NULL,
  `date_created` int(11) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'aditya', '$2y$10$BQUYGICaP7CiHayLEuHAtOeN7HxxxiCXrWuMZSAKOqSfrHfACpZ6.', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (2, 'admin', '$2y$10$2zZRgKgZDNoLoCbXKEwNy.aq48HJw263XF6KgPrm/j.rDK5t.uaLu', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (3, 'user', '$2y$10$yoFywNg3blbJwr4zi72qp.pW2bkDj4f2TkVkssMlplrKV3XLrxMkC', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (7, 'dina2', '$2y$10$iKc/k0JdA18JUCsdoErm6OvDryD8gCYlahF.XOwhyypF96ZiDVHL2', 'Dina Meliana', 'default.jpg', 2, 1, 1602769850, 'dina99@gmail.com');
INSERT INTO `user` VALUES (8, 'aditya2', '$2y$10$PDA1OZHSUSIDflF6RbVPL.cLhbpBwn58CeoRTcexTIYDvhZyHuExy', 'Aditya Noor Sandy', 'default.jpg', 1, 1, 1602818077, 'adityasandy99@gmail.com');

SET FOREIGN_KEY_CHECKS = 1;
