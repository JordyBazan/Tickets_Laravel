-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2025 a las 21:02:13
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hpep_tickets`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cédula', 1, '2024-12-17 12:26:17', '2024-12-17 12:26:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `images`
--

INSERT INTO `images` (`id`, `url`, `imageable_type`, `imageable_id`, `created_at`, `updated_at`) VALUES
(1, 'tickets/0fUcEQjfkZqb6jKh9H7kINC3QeBBcDpA8zCmddHn.jpg', 'App\\Models\\Ticket', 3, '2025-11-28 17:41:15', '2025-11-28 17:41:15'),
(2, 'tickets/zT0HBPJ1h9P8VXbJwrYbf0V2ZR40IteYUtZDP5cr.png', 'App\\Models\\Ticket', 4, '2025-12-03 18:19:03', '2025-12-03 18:19:03'),
(3, 'tickets/UBipGHA3qswBgSlWDmasxzaDhOeby6qRb8BLbnY7.png', 'App\\Models\\Ticket', 5, '2025-12-03 22:27:20', '2025-12-03 22:27:20'),
(4, 'tickets/qh5uRww4WKMyKokdqpp6WDlDNzk596tqtPMvD7pr.jpg', 'App\\Models\\Ticket', 6, '2025-12-03 22:38:29', '2025-12-03 22:38:29'),
(5, 'tickets/IAekV9HQ10pBNorb5QdEcE9hOxkw2sK2BqunigkJ.webp', 'App\\Models\\Ticket', 7, '2025-12-10 18:01:32', '2025-12-10 18:01:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_11_06_132421_create_roles_table', 1),
(11, '2023_11_06_132429_create_permissions_table', 1),
(12, '2023_11_06_132513_create_permission_role_pivot_table', 1),
(13, '2023_11_06_132529_create_role_user_pivot_table', 1),
(14, '2023_11_07_091355_create_document_types_table', 1),
(15, '2023_11_07_101640_add_document_to_users', 1),
(16, '2023_11_09_094325_create_countries_table', 1),
(17, '2023_11_09_094531_create_states_table', 1),
(18, '2023_11_09_094539_create_cities_table', 1),
(19, '2023_11_09_094601_create_currencies_table', 1),
(20, '2023_11_09_120021_create_country_currency_pivot_table', 1),
(21, '2023_11_10_082720_add_phone_code_to_users', 1),
(22, '2023_11_17_155359_add_city_to_users', 1),
(23, '2024_01_18_150738_create_images_table', 1),
(24, '2024_12_18_163819_create_egresos_table', 2),
(25, '0001_01_01_000001_create_cache_table', 3),
(26, '0001_01_01_000002_create_jobs_table', 4),
(27, '2025_11_25_160642_create_ticket_priorities_table', 4),
(28, '2025_11_25_160642_create_ticket_problem_types_table', 4),
(29, '2025_11_25_160642_create_ticket_statuses_table', 4),
(30, '2025_11_25_160643_create_ticket_assignments_table', 4),
(31, '2025_11_25_160651_create_tickets_table', 4),
(32, '2025_11_25_160656_create_ticket_materials_table', 4),
(33, '2025_11_25_160656_create_ticket_updates_table', 4),
(34, '2025_12_02_125352_add_ticket_assignment_id_to_users_table', 5),
(35, '2025_12_02_144612_create_supplies_table', 6),
(36, '2025_12_04_195358_create_permission_user_table', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('cespedesmiguel14@gmail.com', '$2y$12$I5WGEopjQvIA9n5Ufrp7auo4uGvEr0m9ONd/WIv1ivfjGTYihcKUi', '2024-12-18 11:32:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `menu` varchar(150) NOT NULL,
  `permission` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `menu`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'dashboard_view', 'Dashboard', 'View', NULL, NULL),
(2, 'ticket_bandeja_view', 'Ticket', 'View Index', NULL, NULL),
(3, 'ticket_assign_edit', 'Ticket', 'Assign/Edit', NULL, NULL),
(4, 'ticket_admin_delete', 'Ticket', 'Delete', NULL, NULL),
(5, 'ticket_execution', 'Ticket', 'Execute/Log', NULL, NULL),
(6, 'user_index', 'User Mgmt', 'View List', NULL, NULL),
(7, 'user_create_edit', 'User Mgmt', 'Create/Edit', NULL, NULL),
(8, 'user_delete', 'User Mgmt', 'Delete', NULL, NULL),
(9, 'role_manage', 'Roles', 'Manage', NULL, NULL),
(10, 'settings_manage', 'Settings', 'Manage Catalogs', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 9, 1, NULL, NULL),
(3, 10, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 3, 1, NULL, NULL),
(6, 2, 1, NULL, NULL),
(7, 5, 1, NULL, NULL),
(8, 7, 1, NULL, NULL),
(9, 8, 1, NULL, NULL),
(10, 6, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_user`
--

CREATE TABLE `permission_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permission_user`
--

INSERT INTO `permission_user` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(2, 32, 2, NULL, NULL),
(3, 32, 3, NULL, NULL),
(4, 32, 4, NULL, NULL),
(5, 32, 5, NULL, NULL),
(6, 32, 6, NULL, NULL),
(7, 32, 7, NULL, NULL),
(8, 32, 8, NULL, NULL),
(9, 32, 9, NULL, NULL),
(10, 32, 10, NULL, NULL),
(11, 32, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, NULL, NULL),
(2, 'Jefe RRFF', 1, NULL, NULL),
(3, 'Técnico', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(18, 1, 13, NULL, NULL),
(33, 2, 13, NULL, NULL),
(34, 3, 19, NULL, NULL),
(35, 1, 19, NULL, NULL),
(41, 3, 23, NULL, NULL),
(42, 2, 23, NULL, NULL),
(43, 3, 24, NULL, NULL),
(44, 2, 24, NULL, NULL),
(45, 3, 25, NULL, NULL),
(46, 2, 25, NULL, NULL),
(47, 4, 27, NULL, NULL),
(48, 4, 28, NULL, NULL),
(50, 1, 26, NULL, NULL),
(52, 3, 29, NULL, NULL),
(53, 2, 31, NULL, NULL),
(54, 3, 32, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sidra`
--

CREATE TABLE `sidra` (
  `id` int(11) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre_funcionario` varchar(255) NOT NULL,
  `correo_funcionario` varchar(255) NOT NULL,
  `anexo` varchar(20) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `estado` varchar(50) NOT NULL DEFAULT 'inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sidra`
--

INSERT INTO `sidra` (`id`, `servicio`, `rut`, `nombre_funcionario`, `correo_funcionario`, `anexo`, `fecha_registro`, `estado`) VALUES
(33, 'UHTIRI 2', '20575743-0', 'Javiera Escarleth Martinez Cepeda', 'javieramartinezcda@gmail.com', '265446', '2025-06-04 08:18:03', 'activo'),
(34, 'UHTIRI 2', '15440591-7', 'Maria Teresa Gonzalez', 'mary_tere_26@hotmail.com', '265446', '2025-06-04 16:06:26', 'activo'),
(35, 'UHTIRI 1', '20000638-0', 'Paolo Leandro Amaya Rojas', 'paolo.amaya@hpep.cl', '265451', '2025-06-05 16:16:39', 'activo'),
(36, 'UHTIRI 2', '22009867-2', 'isidora antonia zuñiga iglesias', 'isidora.antonia.2711@gmail.com', '265446', '2025-06-08 19:27:21', 'activo'),
(37, 'RESIDENCIAS PROTEGIDAS', '10363220-K', 'Andrea Hernandez', 'andrea.hernandez.s@redsalud.gob.cl', '265438', '2025-06-10 14:29:27', 'activo'),
(38, 'SUB DIRECCION MEDICA', '1697118-7', 'NICHOLE LANZA', 'nichole.lanza@redsalud.gob.cl', '265421', '2025-06-12 10:41:46', 'activo'),
(39, 'UNIDAD DE MEDICINA Y REHABILITACION', '16939974-3', 'Daniela Gutierrez', 'daniela.gutierrezb@redsalud.gob.cl', '265432', '2025-06-19 10:04:54', 'activo'),
(40, 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', '16646130-8', 'Claudia Bustos Gatica', 'claudia.bustosg@redsalud.gob.cl', '265415', '2025-06-19 16:27:01', 'activo'),
(41, 'UHTIRI 1', '18641385-7', 'Gonzalo Duque', 'gonzalo.duque@redsalud.gob.cl', '265410', '2025-06-23 08:12:22', 'activo'),
(42, 'UHTIRI 2', '19136803-7', 'Daniela González Acevedo', 'dgonzalez.acev@gmail.com', '265398', '2025-06-26 15:14:19', 'activo'),
(43, 'SERVICIO DE ALIMENTACION', '1701005-4', 'Katherine Montenegro Ahumada', 'katherine.montenegro@redsalud.gob', '265379', '2025-06-29 09:34:07', 'activo'),
(44, 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', '1647541-0', 'ROSA ALDERETE', 'ROSA.ALDERETE@redsalud.gob.cl', '265388', '2025-06-30 10:33:20', 'activo'),
(45, 'SERVICIO DE FARMACIA', '14145918-K', 'Jeniffer Orellana Leiva', 'secfarmacia.hpep@redsalud.gob.cl', '265400', '2025-06-30 10:54:07', 'activo'),
(46, 'UHTIRI 1', '16945596-1', 'camila bolelli', 'camila.bolelli@redsalud.gob.cl', '265410', '2025-07-03 09:09:35', 'activo'),
(47, 'UHTIRI 1', '1324181-4', 'Nelson Castañeda', 'nelson.castaneda@redsalud.gob.cl', '265406', '2025-07-07 08:18:23', 'activo'),
(48, 'UNIDAD DE CALIDAD Y SEGURIDAD DEL PACIENTE', '21497346-4', 'Benjamin Díaz Jiménez', 'benjamin.diazj@redsalud.gob.cl', '265436', '2025-07-07 09:09:19', 'activo'),
(49, 'Uhtiri 1', '19057311-7', 'Alan Rancuzi Escuti', 'alan.rancuzi@hpep.cl', '265451', '2025-07-07 14:41:00', 'activo'),
(50, 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', '1579017-9', 'michelle sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-07-08 15:39:36', 'activo'),
(51, 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', '15790179-6', 'michelle sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-07-08 15:47:11', 'activo'),
(52, 'SERVICIO DE FARMACIA', '14338643-0', 'LILIAN VILCHES ROJAS', 'ANDREA.ESPINOZA@REDSALUD.GOB.CL', '265382', '2025-07-11 13:25:00', 'activo'),
(53, 'SUB DEPARTAMENTO DE CALIDAD DE VIDA', '1042963-1', 'Fernando Vargas', 'fernando.vargas@redsalud.gob.cl', '265435', '2025-07-15 13:06:37', 'activo'),
(54, 'SUB DIRECCION MEDICA', '1697118-7', 'NICHOLE LANZA', 'nichole.lanza@redsalud.gob.cl', '265421', '2025-07-17 12:09:03', 'activo'),
(55, 'UNIDAD DE MEDICINA Y REHABILITACION', '16745195-0', 'paulina bustos alvarado', 'paulina.bustosa@redsalud.gob.cl', '265432', '2025-07-23 08:36:06', 'activo'),
(56, 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', '15790179-6', 'michelle sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-07-24 12:42:01', 'activo'),
(57, 'UHTIRI 2', '20575743-0', 'Javiera Martinez Cepeda', 'javieramartinezcda@gmail.com', '265398', '2025-07-31 09:02:29', 'activo'),
(58, 'UNIDAD DE CALIDAD Y SEGURIDAD DEL PACIENTE', '20575743-0', 'Javiera Escarleth Martinez Cepeda', 'javieramartinezcda@gmail.com', '265398', '2025-07-31 09:22:01', 'activo'),
(59, 'SERVICIO DE FARMACIA', '14338643-0', 'LILIAN ANDREA VILCHES ROJAS', 'recetario.hpep@redsalud.gob.cl', '265383', '2025-08-04 08:54:13', 'activo'),
(60, 'Unidad De Medicina Y Rehabilitacion', '17852943-9', 'Pamela Alejandra Caullan Martinez', 'c.martinez.pame@gmail.com', '265394', '2025-08-06 13:23:14', 'activo'),
(61, 'UNIDAD DE CALIDAD Y SEGURIDAD DEL PACIENTE', '2149734-6', 'Benjamín Diaz', 'benjamin.diazj@redsalud.gob.cl', '265436', '2025-08-06 16:11:03', 'activo'),
(62, 'UHTIRI 1', '20573927-0', 'valentina huerta toledo', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-08-07 11:32:03', 'activo'),
(63, 'Uhtiri 1', '20573927-0', 'Valentina Huerta Toledo', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-08-07 11:38:24', 'Activo'),
(67, 'Uhtiri 1', '22009867-2', 'Isidora Zuñiga', 'uhtiri.1@hpep.cl', '265448', '2025-08-08 09:06:58', 'Activo'),
(68, 'Uhtiri 1', '19732692-1', 'Oscar', 'uhtiri.1@hpep.cl', '265395', '2025-08-08 10:13:02', 'Activo'),
(69, 'Coordinacion De Gestion De Cuidados', '16839055-6', 'Maria Morales', 'mariajose.moralesv@redsalud.gob.cl', '427', '2025-08-11 12:33:01', 'Activo'),
(70, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '1647541-0', 'Rosa Alderete', 'rosa.alderete@redsalud.gob.cl', '265388', '2025-08-12 10:04:38', 'Activo'),
(71, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '15790179-6', 'Michelle Sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-08-12 15:01:30', 'Activo'),
(72, 'Servicio De Farmacia', '14145918-K', 'Jeniffer Orellana', 'andrealecqf@gmail.com', '265382', '2025-08-13 10:57:01', 'Activo'),
(73, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '16646130-8', 'Claudia Bustos Gatica', 'claudia.bustosg@redsalud.gob.cl', '265415', '2025-08-13 17:04:37', 'Activo'),
(74, 'Departamento De Gestion Del Usuario', '1082636-4', 'Jessica Vallejos Vejar', 'jessica.vallejos@redsalud.gob.cl', '265418', '2025-08-18 10:21:39', 'Activo'),
(75, 'Unidad De Medicina Y Rehabilitacion', '16745195-0', 'Paulina Bustos Alvarado', 'paulina.bustosa@redsalud.gob.cl', '265432', '2025-08-20 08:55:37', 'Activo'),
(76, 'Departamento De Tecnologias De Informacion Y Comunicaciones', '20557971-0', 'Miguel Cespedes', 'miguel.cespedes@redsalud.gob.cl', '265369', '2025-08-20 09:01:45', 'Activo'),
(77, 'Uhtiri 1', '20573927-0', 'Valentina Huerta Toledo', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-08-20 15:22:42', 'Activo'),
(78, 'Uhtiri 1', '20573927-0', 'Valentina Huerta Toledo', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-08-20 15:27:12', 'Activo'),
(79, 'Unidad De Calidad Y Seguridad Del Paciente', '15730431-3', 'Karina Tobar Cofre', 'karinatob@hotmail.com', '265398', '2025-08-20 15:33:16', 'Activo'),
(80, 'Unidad De Calidad Y Seguridad Del Paciente', '1375256-0', 'Andrea Lazcano Garay', 'andrea.lazcanog@redsalud.gob.cl', '265405', '2025-08-25 14:54:49', 'Activo'),
(81, 'Coordinacion De Gestion De Cuidados', '10429631-9', 'Fernando Vargas', 'fernando.vargas@redsalud.gob.cl', '265435', '2025-08-26 08:56:06', 'Activo'),
(82, 'Sub Departamento De Calidad De Vida', '1693338-4', 'Daniela Silva Herrera', 'danisilvah89@gmail.com', '265398', '2025-08-27 09:13:45', 'Activo'),
(83, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '19737815-8', 'Kasandra Robledo Araya', 'urle.hperal@redsalud.gob.cl', '265399', '2025-08-28 09:56:34', 'Activo'),
(84, 'Unidad De Calidad Y Seguridad Del Paciente', '2149734-6', 'Benjamín Diaz', 'benjamin.diazj@redsalud.gob.cl', '265436', '2025-09-01 08:48:05', 'Activo'),
(85, 'Sub Departamento De Calidad De Vida', '18904352-K', 'Michelle Deschamps', 'ule.ucv@hpep.cl', '265398', '2025-09-02 11:01:43', 'Activo'),
(86, 'Unidad De Medicina Y Rehabilitacion', '16745195-0', 'Paulina Bustos Alvarado', 'paulina.bustosa@redsalud.gob.cl', '265432', '2025-09-03 09:57:38', 'Activo'),
(87, 'Unidad De Medicina Y Rehabilitacion', '16939974-3', 'Daniela Gutierrez', 'daniela.gutierrezb@redsalud.gob.cl', '265432', '2025-09-03 09:57:40', 'Activo'),
(88, 'Uhtiri 1', '19710974-2', 'Camila Vargas Castillo', 'dracamilavargasc@gmail.com', '265410', '2025-09-08 09:50:25', 'Activo'),
(89, 'Uhtiri 1', '22632426-7', 'Taine Cerpavelez', 'taine.cerpa@redsalud.gob.cl', '265410', '2025-09-08 09:51:00', 'Activo'),
(90, 'Servicio De Alimentacion', '1701005-4', 'Katherine Montenegro Ahumada', 'katherine.montenegro@redsalud.gob', '265379/ 997144376', '2025-09-08 11:09:05', 'Activo'),
(91, 'Servicio De Alimentacion', '1008023-0', 'Darwin Stuardo', 'darwin.stuardo@redsalud.gob', '265379', '2025-09-08 11:10:55', 'Activo'),
(92, 'Uhtiri 1', '25228136-3', 'Brian Jiménez', 'brian.jimenez@redsalud.gob.cl', '265410', '2025-09-10 10:28:48', 'Activo'),
(93, 'Uhtiri 1', '15157680-K', 'Raul Sanchez Montes', 'raul.sanchezmo@redsalud.gob.cl', '265410', '2025-09-12 10:38:38', 'Activo'),
(94, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '1647541-0', 'Rosa Alderete', 'rosa.alderete@redsalud.gob.cl', '265388', '2025-09-15 11:35:40', 'Activo'),
(95, 'Unidad De Medicina Y Rehabilitacion', '16939974-3', 'Daniela Gutierrez', 'daniela.gutierrezb@redsalud.gob.cl', '265432', '2025-09-16 09:24:00', 'Activo'),
(96, 'Servicio De Farmacia', '1742114-6', 'Nayarett Solange Muñoz Diaz', 'andrea.espinoza@redsalud.gob.cl', '265382', '2025-09-22 09:53:44', 'Activo'),
(97, 'Coordinacion De Gestion De Cuidados', '1042963-1', 'Fernando Vargas', 'fernando.vargas@redsalud.gob.cl', '265435', '2025-09-25 14:18:35', 'Activo'),
(98, 'Uhtiri 1', '20575743-0', 'Javiera Martinez Cepeda', 'javieramartinezcda@gmail.com', '265395', '2025-09-26 09:10:02', 'Activo'),
(99, 'Uhtiri 1', '17189532-4', 'Francisca Lopez Sepulveda', 'ff.lopezsepulveda@gmail.com', '265395', '2025-09-28 08:21:11', 'Activo'),
(100, 'Uhtiri 1', '20573927-0', 'Valentina Huerta', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-10-01 15:45:06', 'Activo'),
(101, 'Uhtiri 1', '20573927-0', 'Valentina Huerta', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-10-01 16:00:04', 'Activo'),
(102, 'Uhtiri 1', '20573927-0', 'Valentina Huerta', 'valentinahuertatoledo2909@gmail.com', '969051666', '2025-10-01 16:16:45', 'Activo'),
(103, 'Uhtiri 1', '1640801-1', 'Fabian Hormazabal', 'fabian.hormazabal@redsalud.gob.cl', '265453', '2025-10-03 11:35:44', 'Activo'),
(104, 'Servicio De Farmacia', '14338643-0', 'Lilian Andrea Vilches Rojas', 'mariana.quiroga@redsalud.gob.cl', '265408', '2025-10-07 08:48:16', 'Activo'),
(105, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '15790179-6', 'Michelle Sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-10-07 09:39:46', 'Activo'),
(106, 'Unidad De Calidad Y Seguridad Del Paciente', '21497346-4', 'Benjamín Diaz', 'benjamin.diazj@redsalud.gob.cl', '265436', '2025-10-07 11:38:44', 'Activo'),
(107, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '1647541-0', 'Rosa Alderete', 'rosa.alderete@redsalud.gob.cl', '265388', '2025-10-08 08:47:45', 'Activo'),
(108, 'Unidad De Medicina Y Rehabilitacion', '16939974-3', 'Daniela Gutierrez', 'daniela.gutierrezb@redsalud.gob.cl', '265432', '2025-10-09 11:34:32', 'Activo'),
(109, 'Uhtiri 2', '15438141-4', 'Ana Inostroza Severino', 'uhtiri2@gmail.com', '265398', '2025-10-15 09:20:23', 'Activo'),
(110, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '15790179-6', 'Michelle Sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-10-20 10:57:34', 'Activo'),
(111, 'Unidad De Calidad Y Seguridad Del Paciente', '21497346-4', 'Benjamin Díaz Jiménez', 'benjamin.diazj@redsalud.gob.cl', '265436', '2025-10-28 13:23:59', 'Activo'),
(112, 'Sub Direccion Medica', '1697118-7', 'Nichole Lanza', 'nichole.lanza@redsalud.gob.cl', '265421', '2025-11-06 14:58:04', 'Activo'),
(113, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '15790179-6', 'Michelle Sereño', 'michelle.sereno@redsalud.gob.cl', '397', '2025-11-06 15:03:45', 'Activo'),
(114, 'Servicio Clinico De Cuidados Y Rehabilitacion Para El Egreso', '1647541-0', 'Rosa Alderete', 'rosa.alderete@redsalud.gob.cl', '265388', '2025-11-11 11:57:02', 'Activo'),
(115, 'Unidad De Medicina Y Rehabilitacion', '26210576-8', 'Mauricio Dorn', 'mauricio.dorna@redsalud.gob.cl', '265934', '2025-11-19 07:16:11', 'Activo'),
(116, 'Sub Direccion Medica', '1697118-7', 'Nichole Lanza', 'nichole.lanza@redsalud.gob.cl', '265421', '2025-11-19 08:59:55', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies`
--

CREATE TABLE `supplies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT 'un',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `supplies`
--

INSERT INTO `supplies` (`id`, `name`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'tornillos 1/4', NULL, '2025-12-02 19:12:29', '2025-12-02 19:12:29'),
(2, 'cable de luz', NULL, '2025-12-02 19:12:48', '2025-12-02 19:12:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_number` varchar(20) DEFAULT NULL,
  `unit_service` varchar(255) NOT NULL,
  `applicant_name` varchar(150) NOT NULL,
  `applicant_email` varchar(255) NOT NULL,
  `applicant_rut` varchar(12) NOT NULL,
  `applicant_annex` varchar(20) DEFAULT NULL,
  `problem_type_id` bigint(20) UNSIGNED NOT NULL,
  `initial_priority_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_priority_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_to_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assignment_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `execution_details` text DEFAULT NULL,
  `time_spent_hours` decimal(8,2) DEFAULT NULL,
  `reception_approved` tinyint(1) NOT NULL DEFAULT 0,
  `reception_comments` text DEFAULT NULL,
  `secure_token` varchar(60) DEFAULT NULL,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `ticket_number`, `unit_service`, `applicant_name`, `applicant_email`, `applicant_rut`, `applicant_annex`, `problem_type_id`, `initial_priority_id`, `assigned_priority_id`, `description`, `status_id`, `assigned_to_user_id`, `assignment_type_id`, `execution_details`, `time_spent_hours`, `reception_approved`, `reception_comments`, `secure_token`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 'OT-00001', 'Departamento De Tecnologias De Informacion Y Comunicaciones', 'Jordy Bazan', 'jordy@hpep.cl', '22.655.559-5', '265485', 1, 2, 2, 'no funciona el aire acondicionado', 3, 29, 1, '[02/12 18:13] felipe: sdfsdfsdfdfsdf', 349.00, 0, NULL, 'iIqRB0gIlHsH0UFofnUMoluOKx7dMtu4PPyjoWh8Afeb0ZBXGru7HH7rOlth', NULL, '2025-11-28 16:49:18', '2025-12-02 21:13:57'),
(2, 'OT-00002', 'Departamento De Tecnologias De Informacion Y Comunicaciones', 'belen aravena', 'belen@hpep.cl', '21.655.559-6', '265485', 1, 2, 2, 'no funciona el aire acondicionado otra vez', 3, 29, 1, NULL, 4.00, 0, NULL, 'IWtoCV2Q0Br8Wsy0bLCCIneYyUOMWw1nMsptggddJdEBKHY3qbaK1KxWXiVQ', NULL, '2025-11-28 16:52:45', '2025-12-02 19:22:31'),
(3, 'OT-00003', 'Departamento De Tecnologias De Informacion Y Comunicaciones', 'belen aravena', 'belen@hpep.cl', '21.655.559-6', '265485', 1, 2, 2, 'no funciona el aire acondicionado otra vez', 3, 29, 1, NULL, 1.00, 0, NULL, 'Kooy7SnG3TjMVQhASZs1sC5evvZYfmQaAmgm3pTqswMMKKdPMXQJ8AXCKBLr', NULL, '2025-11-28 17:41:15', '2025-12-02 19:15:30'),
(4, 'OT-00004', 'Departamento De Tecnologias De Informacion Y Comunicaciones', 'Jordy Bazan', 'jordy@hpep.cl', '22.655.559-5', '265485', 1, 4, NULL, 'otro problema', 2, 29, 1, NULL, NULL, 0, NULL, 'cU20TfsSwHnf2zoqaebyvz8Kd2MNcf9x44ErRHlCaNoVGrRpyqBDae1mAtnU', NULL, '2025-12-03 18:19:03', '2025-12-03 18:19:37'),
(5, 'OT-00005', 'Departamento De Tecnologias De Informacion Y Comunicaciones', 'belen aravena', 'belen@hpep.cl', '22.655.559-5', '265485', 1, 1, NULL, 'no funciona', 3, 29, 1, '[03/12 19:29] felipeee: gdtfth', 3.00, 0, NULL, 'R9SwVaO7z6OqHEOnah23iIQIgwOXLs0EsGUHcDlvVsrBgm212hboDzDnRnBF', NULL, '2025-12-03 22:27:20', '2025-12-03 22:29:50'),
(6, 'OT-00006', 'SERVICIO CLINICO DE CUIDADOS Y REHABILITACION PARA EL EGRESO', 'belen aravena', 'jordy@hpep.cl', '22.655.559-5', '265485', 1, 3, NULL, 'ewrewrewrwerwerwerwer', 2, 32, 1, NULL, NULL, 0, NULL, 'gPTCt2464jJ0hy07Yl6sSflcjptGrdui3nop9zMv1vF3w41XWgLGrQqgzvhx', NULL, '2025-12-03 22:38:29', '2025-12-10 22:45:48'),
(7, 'OT-00007', 'Coordinacion De Gestion De Cuidados', 'belen aravena', 'belen@hpep.cl', '22.655.559-5', '265485', 1, 2, NULL, 'ghjkfghghj', 3, 32, 1, NULL, NULL, 0, NULL, 'MPIZdOcHbU1yoobDjrWxfNjW6ODG5Eyx2bIb87QSWPmBBx9GyneoY9mm476z', NULL, '2025-12-10 18:01:31', '2025-12-10 18:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_assignments`
--

CREATE TABLE `ticket_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_assignments`
--

INSERT INTO `ticket_assignments` (`id`, `name`, `is_internal`, `created_at`, `updated_at`) VALUES
(1, 'Taller Gasfiteria', 1, '2025-11-28 18:20:20', '2025-11-28 18:20:20'),
(2, 'Taller Carpinteria', 1, '2025-12-02 19:14:27', '2025-12-02 19:14:27'),
(3, 'Taller Electricidad', 1, '2025-12-02 19:14:37', '2025-12-02 19:14:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_materials`
--

CREATE TABLE `ticket_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `material_name` varchar(255) NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `unit` varchar(50) DEFAULT 'un'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_materials`
--

INSERT INTO `ticket_materials` (`id`, `ticket_id`, `user_id`, `created_at`, `updated_at`, `material_name`, `quantity`, `unit`) VALUES
(1, 5, 29, '2025-12-03 22:29:50', '2025-12-03 22:29:50', 'tornillos 1/4', 34.00, 'un');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_priorities`
--

CREATE TABLE `ticket_priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `level` int(11) NOT NULL COMMENT '1=Crítica, 4=Baja',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_priorities`
--

INSERT INTO `ticket_priorities` (`id`, `name`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Urgente / Crítica', 1, NULL, NULL),
(2, 'Alta', 2, NULL, NULL),
(3, 'Media', 3, NULL, NULL),
(4, 'Baja', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_problem_types`
--

CREATE TABLE `ticket_problem_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_problem_types`
--

INSERT INTO `ticket_problem_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Aire Acondicionado', '2025-11-28 16:22:22', '2025-11-28 16:22:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_statuses`
--

CREATE TABLE `ticket_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ticket_statuses`
--

INSERT INTO `ticket_statuses` (`id`, `name`, `is_closed`, `created_at`, `updated_at`) VALUES
(1, 'Abierto', 0, NULL, NULL),
(2, 'En proceso', 0, NULL, NULL),
(3, 'Cerrado', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_updates`
--

CREATE TABLE `ticket_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_type_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_assignment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `document_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `remember_token`, `status`, `created_at`, `updated_at`, `document_type_id`, `ticket_assignment_id`, `document_number`) VALUES
(26, 'Admin', 'RRFF', 'admin@hpep.cl', NULL, '$2y$12$oJP5Jb5CbMwM4V7cSWY.xuPlMuuRSrxr9ytt3PxbblVKLPNnhDoY6', NULL, 1, '2025-11-25 23:02:21', '2025-12-02 15:15:58', 1, NULL, '11111111-1'),
(29, 'felipeee', 'rodriguezzz', 'felipe.ro@hpep.cl', NULL, '$2y$12$G25kvTyDTw1PVWP0OB4r3edvxAeeR7viF4tBUH5ZcHObhhr6Py6RK', NULL, 1, '2025-12-02 16:24:12', '2025-12-03 17:49:07', 1, 1, '222444494-3'),
(31, 'Jordy', 'Bazan', 'jordy.bazan@hpep.cl', NULL, '$2y$12$H1h1CfEUbwOySCrkUfqyFuI5hhJTbHPKZEkcZDi.3sDw5CnlPVUqu', NULL, 1, '2025-12-03 22:37:25', '2025-12-03 22:37:25', 1, NULL, '22655559-5'),
(32, 'miguel', 'cespedez', 'belen.aravena@hpep.cl', NULL, '$2y$12$bpDxiffdCWhm.vT0xI.M8.NetPptbaHFCC0Y2Yq.UdiTEEHVTFVga', NULL, 1, '2025-12-03 22:43:22', '2025-12-03 22:43:22', 1, 2, '12312312-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_problemas`
--

CREATE TABLE `usuarios_problemas` (
  `id` int(11) NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `rut` varchar(12) NOT NULL,
  `nombre_funcionario` varchar(150) NOT NULL,
  `correo_funcionario` varchar(150) DEFAULT NULL,
  `anexo` varchar(20) DEFAULT NULL,
  `tipo_problema` varchar(100) NOT NULL,
  `tipo_prioridad` varchar(50) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `numero_ticket` varchar(20) DEFAULT NULL,
  `estado_ticket` varchar(50) DEFAULT 'Abierto',
  `descripcion_resolucion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_usuario_asignado` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `document_types_name_unique` (`name`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `images_url_unique` (`url`),
  ADD KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_title_unique` (`title`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_user_user_id_foreign` (`user_id`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sidra`
--
ALTER TABLE `sidra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tickets_ticket_number_unique` (`ticket_number`),
  ADD KEY `tickets_problem_type_id_foreign` (`problem_type_id`),
  ADD KEY `tickets_initial_priority_id_foreign` (`initial_priority_id`),
  ADD KEY `tickets_assigned_priority_id_foreign` (`assigned_priority_id`),
  ADD KEY `tickets_status_id_foreign` (`status_id`),
  ADD KEY `tickets_assigned_to_user_id_foreign` (`assigned_to_user_id`),
  ADD KEY `tickets_assignment_type_id_foreign` (`assignment_type_id`);

--
-- Indices de la tabla `ticket_assignments`
--
ALTER TABLE `ticket_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_materials`
--
ALTER TABLE `ticket_materials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_problem_types`
--
ALTER TABLE `ticket_problem_types`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket_updates`
--
ALTER TABLE `ticket_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_ticket_assignment_id_foreign` (`ticket_assignment_id`);

--
-- Indices de la tabla `usuarios_problemas`
--
ALTER TABLE `usuarios_problemas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_ticket` (`numero_ticket`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `sidra`
--
ALTER TABLE `sidra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT de la tabla `supplies`
--
ALTER TABLE `supplies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `ticket_assignments`
--
ALTER TABLE `ticket_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ticket_materials`
--
ALTER TABLE `ticket_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ticket_priorities`
--
ALTER TABLE `ticket_priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ticket_problem_types`
--
ALTER TABLE `ticket_problem_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ticket_statuses`
--
ALTER TABLE `ticket_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ticket_updates`
--
ALTER TABLE `ticket_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `usuarios_problemas`
--
ALTER TABLE `usuarios_problemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_assigned_priority_id_foreign` FOREIGN KEY (`assigned_priority_id`) REFERENCES `ticket_priorities` (`id`),
  ADD CONSTRAINT `tickets_assigned_to_user_id_foreign` FOREIGN KEY (`assigned_to_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_assignment_type_id_foreign` FOREIGN KEY (`assignment_type_id`) REFERENCES `ticket_assignments` (`id`),
  ADD CONSTRAINT `tickets_initial_priority_id_foreign` FOREIGN KEY (`initial_priority_id`) REFERENCES `ticket_priorities` (`id`),
  ADD CONSTRAINT `tickets_problem_type_id_foreign` FOREIGN KEY (`problem_type_id`) REFERENCES `ticket_problem_types` (`id`),
  ADD CONSTRAINT `tickets_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `ticket_statuses` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ticket_assignment_id_foreign` FOREIGN KEY (`ticket_assignment_id`) REFERENCES `ticket_assignments` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
