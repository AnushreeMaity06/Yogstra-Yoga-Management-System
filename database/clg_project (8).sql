-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2026 at 10:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clg_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `qualification` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email_id`, `password`, `gender`, `qualification`, `image`) VALUES
(2, 'Anushree Maity', 'anushreemaity06@gmail.com', 'd00435fb055f776f7f2e6fb1c18784e3', 'female', 'graduation', '');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subtitle`, `image`, `status`) VALUES
(4, 'Balance your body, calm your mind.', 'The body benefits from movement, and the mind benefits from stillness.', '1778176132_beautiful-girl-doing-yoga-illustration-international-yoga-day-yoga-day-banner-yoga-day-background-vector.jpg', 0),
(5, 'Awaken Your Mind & Body.', 'Improve focus, clarity, peace, and positive thinking.', '25770324-magnifique-fille-faire-yoga-dans-lever-du-soleil-illustration-vectoriel.jpg', 1),
(7, 'Start Your Yoga Journey Today.', 'Improve flexibility, strength, and mental clarity with daily practice.', 'il_fullxfull.6188745219_riqb.webp', 1),
(8, 'Better yoga for people', 'The body benefits from movement, and the mind benefits from stillness.', 'young-girl-demonstrating-upward-plank-pose-with-nature-and-leaves-background-flexible-woman-doing-purvottanasana-yoga-pose-with-wheel-yoga-wheel-training-pose-illustration-vector.jpg', 1),
(9, 'Find Your Inner Peace.', 'Join our yoga journey to relax your mind, strengthen your body, and balance your life..', 'Yoga-Graphics-44754445-1.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `read_time` varchar(50) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `category`, `description`, `image`, `read_time`, `slug`, `created_at`) VALUES
(5, 'The Benefits of Daily Meditation.', 'Meditation', 'Meditation is a simple yet powerful practice that can improve both mental and physical health. Spending just a few minutes each day in meditation can help reduce stress and improve focus.\r\n\r\nOne of the greatest benefits of meditation is increased mindfulness. It allows you to become more aware of your thoughts and emotions without feeling overwhelmed.\r\n\r\nMeditation also helps lower anxiety and promotes better sleep. People who meditate regularly often experience improved concentration and emotional balance.\r\n\r\nTo begin, find a quiet place, sit comfortably, and focus on your breathing. Start with five minutes a day and gradually increase the duration as you become more comfortable.\r\n\r\nWith consistency, meditation can become a valuable habit that brings peace and positivity into your daily life.', 'morning-yoga-practice-stockcake.webp', '4 Min Read', NULL, '2026-06-10 06:22:41'),
(6, 'Healthy Eating Habits for a Better Life.', 'Nutrition', 'Healthy eating plays an important role in maintaining overall well-being. A balanced diet provides essential nutrients that support the body\'s growth and daily functions.\r\n\r\nInclude a variety of fruits, vegetables, whole grains, and lean proteins in your meals. Drinking enough water throughout the day is equally important.\r\n\r\nAvoid excessive consumption of processed foods, sugary drinks, and unhealthy fats. Instead, focus on fresh and natural ingredients whenever possible.\r\n\r\nEating smaller portions and maintaining a regular meal schedule can help improve digestion and energy levels.\r\n\r\nBy making healthier food choices, you can reduce the risk of many diseases and enjoy a more active lifestyle.', 'Sattvic-Food.webp', '6 Min Read', NULL, '2026-06-10 06:27:17'),
(7, '7 Tips for Better Sleep Quality.', 'Sleep', 'Good sleep is essential for physical and mental health. Lack of sleep can affect concentration, mood, and overall productivity.\r\n\r\nMaintaining a consistent sleep schedule helps regulate your body\'s internal clock. Try to go to bed and wake up at the same time every day.\r\n\r\nAvoid using electronic devices before bedtime, as blue light can interfere with sleep. Creating a relaxing bedtime routine can also improve sleep quality.\r\n\r\nLimit caffeine intake in the evening and make sure your sleeping environment is quiet and comfortable.\r\n\r\nGetting seven to eight hours of quality sleep each night can improve memory, boost immunity, and increase energy levels.', 'Web-Body-Images4-2.jpg', '5 Min Read', NULL, '2026-06-10 06:30:33'),
(8, 'Simple Exercises to Stay Active.', 'Fitness', 'Regular physical activity is important for maintaining a healthy body and mind. Exercise helps strengthen muscles, improve heart health, and increase energy levels.\r\n\r\nWalking is one of the easiest and most effective forms of exercise. It requires no special equipment and can be done almost anywhere.\r\n\r\nStretching exercises improve flexibility and reduce the risk of injury. Strength training exercises such as push-ups and squats help build muscle and endurance.\r\n\r\nEven thirty minutes of moderate exercise each day can make a significant difference in your overall health.\r\n\r\nStaying active not only benefits your body but also improves mood and reduces stress.', 'Warrior-Yoga-Pose-by-Woman-Wallpaper-for-Wall.jpg', '5 Min Read', NULL, '2026-06-10 06:31:47'),
(9, 'How to Manage Stress Effectively.', 'Stress Management', 'Stress is a normal part of life, but managing it properly is important for maintaining good health. Chronic stress can affect both physical and emotional well-being.\r\n\r\nPracticing deep breathing exercises and meditation can help calm the mind and reduce tension. Physical activity is another effective way to manage stress.\r\n\r\nTaking breaks, spending time with loved ones, and engaging in hobbies can provide relaxation and improve mood.\r\n\r\nMaintaining a healthy lifestyle, including proper sleep and balanced nutrition, also plays a major role in stress management.\r\n\r\n', 'RS_YogaStressExercises_Tout_2-91057621720c49f585c6042e253dfc20.jpg', '9 Min Read', NULL, '2026-06-10 06:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(255) NOT NULL,
  `user_id` int(100) NOT NULL,
  `class_id` int(100) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `seats` int(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `class_id`, `date`, `time`, `seats`, `status`, `payment_status`, `total_price`) VALUES
(35, 2, 12, '2026-06-15', '09:03:00', 3, '', '', 9600),
(36, 66, 12, '2026-06-15', '09:12:00', 3, '', '', 9600),
(37, 66, 15, '2026-06-15', '09:53:00', 2, '', '', 2400),
(38, 66, 18, '2026-06-15', '10:11:00', 8, '', '', 200),
(39, 71, 2, '2026-07-31', '20:36:00', 2, '', '', 6400);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `description` text NOT NULL,
  `benefits` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active',
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `instructor`, `level`, `duration`, `price`, `schedule_date`, `start_time`, `end_time`, `description`, `benefits`, `status`, `created_by`) VALUES
(2, 'Vinyasa Flow', 'Jhon Due', 'Beginner', 30, 3200.00, '2026-06-20', '15:08:00', '15:38:00', '        A dynamic, breath-to-movement practice designed to build strength and flexibility.', '    Improves flexibility, Reduces stress, Enhances balance, Boosts energy    ', 'Active', NULL),
(3, 'Hatha Yoga', 'David Storm', 'Intermediate', 25, 2500.00, '2026-07-31', '05:00:00', '05:25:00', '        Traditional yoga focusing on posture and breathing', '        Improves balance, strength and relaxation', 'Active', NULL),
(4, 'Beginner Yoga', 'Jhon Due', 'Beginner', 30, 2800.00, '2026-07-31', '10:30:00', '11:00:00', '        Basic yoga poses and breathing techniques for beginners', '    Improves flexibility, reduces stress, builds body awareness    ', 'Active', NULL),
(5, 'Kids Yoga', 'David Storm', 'Advanced', 25, 3500.00, '2026-07-31', '01:00:00', '01:25:00', '        Fun yoga exercises designed for children', '      Improves focus, flexibility and confidence  ', 'Active', NULL),
(6, 'Aerial Yoga', 'David Storm', 'Advanced', 30, 4000.00, '2026-07-31', '01:40:00', '02:10:00', '        Yoga practice using aerial hammock support', '     Improves flexibility and body strength   ', 'Active', NULL),
(7, 'Morning Wellness Yoga', 'Kaelen Moon', 'Beginner', 25, 4000.00, '2026-07-31', '04:30:00', '04:55:00', '        Morning yoga routine for healthy lifestyle', '      Boosts energy and improves posture  ', 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `member_since` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_classes`
--

CREATE TABLE `live_classes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `instructor` varchar(100) DEFAULT NULL,
  `meeting_link` text DEFAULT NULL,
  `class_date` date DEFAULT NULL,
  `class_time` time DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership_plans`
--

CREATE TABLE `membership_plans` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `feature1` varchar(255) DEFAULT NULL,
  `feature2` varchar(255) DEFAULT NULL,
  `feature3` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `membership_plans`
--

INSERT INTO `membership_plans` (`id`, `title`, `description`, `price`, `feature1`, `feature2`, `feature3`, `status`) VALUES
(3, 'Essential', 'Perfect for beginners.', 500.00, '10 Live classes per month', 'Core library accesses', 'Community forum access', 1),
(5, 'Essential', 'Perfect for beginners.', 900.00, '10 Live classes per year', 'Core library access', 'Community forum access', 1),
(6, 'Essential', 'Perfect for beginners.', 500.00, '10 Live classes per month', 'Core library access', 'Community forum access', 1),
(7, 'Radiant', 'The complete experience.', 300.00, 'Unlimited Live classes', 'Full on-demand library', 'Early access to workshops', 1),
(8, 'Infinite', 'Elevated wellness journey.', 600.00, 'Everything in Radiant', 'Personalized yoga plan', 'Priority support & booking', 1),
(9, 'Essential', 'Perfect for beginners.', 500.00, '10 Live classes per month', 'Core library access', 'Community forum access', 1),
(10, 'Essential', 'Perfect for beginners.', 1500.00, '10 Live classes per month', 'Core library access', 'Community forum access', 1),
(11, 'Essential', 'Perfect for beginners.', 1500.00, '10 Live classes per month', 'Core library access', 'Community forum access', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `ph_no` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `gender`, `role`, `qualification`, `ph_no`, `address`, `image`, `otp`, `is_verified`) VALUES
(58, 'Kaelen Moon', 'kaslen@gmail.com', '', 'Male', 'teacher', '', '8767509547', 'UP', '1780305838_team1.avif', NULL, 0),
(61, 'Manami Ghosh', 'manamig@gmail.com', 'manami', 'female', 'student', '', '8675093430', 'Bangalore', '1780559272_sukuna.jfif', NULL, 0),
(62, 'Jhon Due', 'jhond@gmail.com', 'jhond', 'male', 'teacher', '', '6296784570', 'Haldiya', 'images.jpeg', NULL, 0),
(65, 'David Storm', 'david@gmail.com', '', 'Male', 'teacher', '', '7856904530', 'Kolkata', '1781335692_team2.avif', NULL, 0),
(67, 'Subham Das', 'subhamd@gmail.com', '$2y$10$Ns1RJao2ITnhkDeoF9aWzOITHH3r1Y5xNmeTXbD.AuWr3s8zPvAaC', 'male', 'teacher', '', '8675093430', 'Bangalore', 'blue-circle-with-white-user_78370-4707.avif', 718166, 0),
(69, 'Anupama Bera', 'anupama@gmail.com', '$2y$10$Itb4HBVnNd0.P8gfTY.wmeoyQrEvi75LCpW4rS3TzoZb.4edqHcIC', 'female', 'teacher', '', '9078567834', 'Mumbai', 'Image-for-Cute-Girl-Hidden-Face-Profile-Picture-Download-for-Fb-4.jpg', NULL, 1),
(70, 'Anushree Maity', 'cclms@gmail.com', '$2y$10$7NBUNHFT8xw.47gWxO.mlOYmLYBIr1WYDRB5ZV8KDnZFnKOLI.co.', 'female', 'teacher', '', '9078567838', 'Kolkata', 'img-chakra-course.jpg', NULL, 1),
(71, 'Anushree Maity', 'anushreemaity06@gmail.com', '$2y$10$tw4wuU/jG78UFoLAf.2xoekARDfYmfomuVEoqp4sJ6eZuJdmz27cK', 'female', 'student', '', '8675093430', 'Bangalore', 'cute-girl-pic26.jpg', NULL, 1),
(72, 'Kanika Maity', 'kanika@gmail.com', '$2y$10$bVHO2w3IZuICEFKxIsW5ZehdquWLUN9GREno.6rwTwfEq2K41HgVm', 'female', 'teacher', '', '9078567834', 'kolkata', '10-minute-yoga.avif', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `video_file` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `uploaded_by` int(11) DEFAULT NULL,
  `uploader_role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `thumbnail`, `video_file`, `category`, `created_at`, `uploaded_by`, `uploader_role`) VALUES
(11, 'Basic Yoga Poses for Beginners', 'Learn the fundamentals of yoga and basic breathing techniques.', 'images.png', '134467-759723595_medium (1).mp4', 'Beginner Yoga', '2026-06-13 07:42:25', 2, 'student'),
(12, 'Morning Stretch Flow', 'Start your day with refreshing stretches and gentle movements.', 'Yoga-Graphics-44754445-1.png', '6696219-uhd_2160_3840_24fps.mp4', 'Beginner Yoga', '2026-06-13 07:45:26', 2, 'student'),
(13, 'Gentle Full Body Yoga', 'Improve flexibility and relaxation with easy poses.', 'young-girl-demonstrating-upward-plank-pose-with-nature-and-leaves-background-flexible-woman-doing-purvottanasana-yoga-pose-with-wheel-yoga-wheel-training-pose-illustration-vector.jpg', '8152219-hd_1920_1080_30fps.mp4', 'Morning Yoga', '2026-06-13 07:47:42', 2, 'student'),
(14, 'Sun Salutation Practice', 'Learn and practice the traditional Surya Namaskar sequence.', 'yoga1.jpg', '6696219-uhd_2160_3840_24fps.mp4', 'Beginner Yoga', '2026-06-13 07:58:33', 2, 'student'),
(15, 'Stress Relief Yoga', 'Reduce anxiety and tension with calming yoga poses.', '10-minute-yoga.avif', '8456781-hd_1920_1080_25fps.mp4', 'Relaxation Yoga', '2026-06-13 07:59:35', 2, 'student'),
(16, 'Yoga for Menstrual Comfort', 'Ease discomfort and promote relaxation.', '69e138bef6a4b4529f2d04fc_69e0f54ed5181529b0763230_Yoga.webp', '6707266-hd_1920_1080_25fps.mp4', 'Womens Yoga', '2026-06-13 08:54:10', 2, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_booking` (`user_id`,`class_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_classes`
--
ALTER TABLE `live_classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_plans`
--
ALTER TABLE `membership_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `live_classes`
--
ALTER TABLE `live_classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership_plans`
--
ALTER TABLE `membership_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
