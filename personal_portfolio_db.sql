-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2021 at 11:07 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `personal_portfolio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_12_06_201034_create_profiler_infos_table', 1),
(6, '2021_12_06_201047_create_profiler_emails_table', 1),
(7, '2021_12_06_201112_create_profiler_academics_table', 1),
(8, '2021_12_06_201125_create_profiler_skills_table', 1),
(9, '2021_12_06_201148_create_profiler_exps_table', 1),
(10, '2021_12_06_201201_create_profiler_ips_table', 1),
(11, '2021_12_06_201214_create_profiler_langs_table', 1),
(12, '2021_12_06_201242_create_profiler_contracts_table', 1),
(13, '2021_12_06_201256_create_profiler_projects_table', 1),
(14, '2021_12_06_201314_create_profiler_medicals_table', 1),
(15, '2021_12_06_201328_create_profiler_residents_table', 1),
(16, '2021_12_06_201343_create_profiler_telephones_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profiler_academics`
--

CREATE TABLE `profiler_academics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diploma_title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diploma_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `institution_attended` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `started_on` date NOT NULL,
  `finished_on` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_academics`
--

INSERT INTO `profiler_academics` (`id`, `diploma_title`, `diploma_description`, `institution_attended`, `profiler_infos_id`, `started_on`, `finished_on`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'GCE O - Level', 'Passed with 9 papers and a total of 15 points', 'B.G.S Molyko Buea', 1, '2015-09-07', '2016-08-01', NULL, '2021-12-13 07:29:42', '2021-12-13 07:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_contracts`
--

CREATE TABLE `profiler_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_type` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `started_on` date NOT NULL,
  `finished_on` date NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_contracts`
--

INSERT INTO `profiler_contracts` (`id`, `contract_type`, `contract_description`, `profiler_infos_id`, `started_on`, `finished_on`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'short-term', 'Participate in the development of the Kamax Academy plateforme', 1, '2021-05-19', '2021-07-30', NULL, '2021-12-13 07:35:13', '2021-12-13 07:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_emails`
--

CREATE TABLE `profiler_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profiler_email` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_emails`
--

INSERT INTO `profiler_emails` (`id`, `profiler_email`, `email_description`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Stevetenadjang@gmail.com', 'Github, LinkedIn, Google', 1, NULL, '2021-12-13 07:42:36', '2021-12-13 07:42:36');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_exps`
--

CREATE TABLE `profiler_exps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_title` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_website` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_start_date` date NOT NULL,
  `job_end_date` date DEFAULT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_exps`
--

INSERT INTO `profiler_exps` (`id`, `job_title`, `job_description`, `company_name`, `company_website`, `job_start_date`, `job_end_date`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'QA tester', 'Testing the company\'s applications for bugs, bugs reporting using jira, test case writing and also free testing', 'Tello System', 'https://dps.bazzptt.com/', '2021-07-21', '2021-10-08', 1, NULL, '2021-12-13 07:48:59', '2021-12-13 07:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_infos`
--

CREATE TABLE `profiler_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_origin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'west',
  `number_of_children` tinyint(4) DEFAULT NULL,
  `married` tinyint(1) NOT NULL DEFAULT 0,
  `profiler_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_infos`
--

INSERT INTO `profiler_infos` (`id`, `first_name`, `last_name`, `gender`, `place_of_birth`, `date_of_birth`, `profession`, `place_of_origin`, `number_of_children`, `married`, `profiler_image`, `background_image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'TENADJANG', 'STEVE', 'male', 'Douala', '2001-04-07', 'Software Engineer / Developer', 'West - Cameroon', 0, 0, 'images/profiler_images/2021-12-13-400097100969_536741.jpg-61b701f93fba62.65420517-1226-1280/c2fACq2jTyvdYK2roFtUgNczsQDVAwzWO5y5fXkK.jpg', 'images/bg_images/2021-12-13-background-blur-clean-clear-531880.jpg-61b701f94d4050.06616437-1920-1200/lxisO4jewmOxysFXy1K4UXuhSca0KZlBqOdxkhlQ.jpg', NULL, '2021-12-13 07:19:05', '2021-12-13 07:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_ips`
--

CREATE TABLE `profiler_ips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_name` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_ips`
--

INSERT INTO `profiler_ips` (`id`, `ip_name`, `ip_description`, `ip_img`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Music Listening', 'Rap Game, Hip-Hop and a bit a pop', 'images/ips_images/2021-12-13-icons8-listening-to-music-on-headphones-96.png-61b70b6eb62891.93710889-96-96/a89xWpsc7zZtkIvGSNhUKtjh4zEBgbnyPaULEhVw.png', 1, NULL, '2021-12-13 07:59:26', '2021-12-13 07:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_langs`
--

CREATE TABLE `profiler_langs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_level` tinyint(3) UNSIGNED NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_langs`
--

INSERT INTO `profiler_langs` (`id`, `language`, `language_level`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'English', 8, 1, NULL, '2021-12-13 08:00:57', '2021-12-13 08:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_medicals`
--

CREATE TABLE `profiler_medicals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `medical_status` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `medical_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_medicals`
--

INSERT INTO `profiler_medicals` (`id`, `medical_status`, `medical_description`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'RAS', 'RAS', 1, NULL, '2021-12-13 09:07:04', '2021-12-13 09:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_projects`
--

CREATE TABLE `profiler_projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_title` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `started_on` date NOT NULL,
  `finished_on` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_projects`
--

INSERT INTO `profiler_projects` (`id`, `project_title`, `project_link`, `project_description`, `profiler_infos_id`, `started_on`, `finished_on`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Kamax Academy', 'https://kamaxacademy.com/', 'Member of the team incharge for developping the company\'s Web plateforme.', 1, '2021-05-19', '2021-07-30', NULL, '2021-12-13 08:18:38', '2021-12-13 08:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_residents`
--

CREATE TABLE `profiler_residents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `place_of_residence` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_of_residence` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_of_residence` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `residence_longitude` double NOT NULL,
  `residence_latitude` double NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_residents`
--

INSERT INTO `profiler_residents` (`id`, `place_of_residence`, `city_of_residence`, `country_of_residence`, `residence_longitude`, `residence_latitude`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Logbessou - logpom', 'Douala', 'Cameroon', 9.780737, 4.09028, 1, NULL, '2021-12-13 08:34:42', '2021-12-13 08:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_skills`
--

CREATE TABLE `profiler_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `skill_title` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_level` tinyint(4) NOT NULL,
  `skill_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_skills`
--

INSERT INTO `profiler_skills` (`id`, `skill_title`, `skill_level`, `skill_description`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Back-end Development', 90, 'Laravel, dotNet', 1, NULL, '2021-12-13 08:39:42', '2021-12-13 08:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `profiler_telephones`
--

CREATE TABLE `profiler_telephones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profiler_phone_number` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number_description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiler_telephones`
--

INSERT INTO `profiler_telephones` (`id`, `profiler_phone_number`, `phone_number_description`, `profiler_infos_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '653-051-037', 'Mobile - whatsapp - Telegram', 1, NULL, '2021-12-13 08:53:59', '2021-12-13 08:53:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profiler_infos_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profiler_infos_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Stevetenadjang', 'SteveteStevetenadjang@gmail.com', NULL, 'root12@@', 1, NULL, NULL, '2021-12-13 08:58:23', '2021-12-13 08:58:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `profiler_academics`
--
ALTER TABLE `profiler_academics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_contracts`
--
ALTER TABLE `profiler_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_emails`
--
ALTER TABLE `profiler_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_exps`
--
ALTER TABLE `profiler_exps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_infos`
--
ALTER TABLE `profiler_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_ips`
--
ALTER TABLE `profiler_ips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_langs`
--
ALTER TABLE `profiler_langs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_medicals`
--
ALTER TABLE `profiler_medicals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_projects`
--
ALTER TABLE `profiler_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_residents`
--
ALTER TABLE `profiler_residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_skills`
--
ALTER TABLE `profiler_skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profiler_telephones`
--
ALTER TABLE `profiler_telephones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profiler_academics`
--
ALTER TABLE `profiler_academics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_contracts`
--
ALTER TABLE `profiler_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_emails`
--
ALTER TABLE `profiler_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_exps`
--
ALTER TABLE `profiler_exps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_infos`
--
ALTER TABLE `profiler_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_ips`
--
ALTER TABLE `profiler_ips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_langs`
--
ALTER TABLE `profiler_langs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_medicals`
--
ALTER TABLE `profiler_medicals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_projects`
--
ALTER TABLE `profiler_projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profiler_residents`
--
ALTER TABLE `profiler_residents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_skills`
--
ALTER TABLE `profiler_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiler_telephones`
--
ALTER TABLE `profiler_telephones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
