-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2015 at 10:02 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sunypub`
--

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE IF NOT EXISTS `journal` (
  `issn` int(10) NOT NULL,
  `date` varchar(12) NOT NULL,
  `jname` varchar(100) NOT NULL,
  `issue` int(10) NOT NULL,
  `volume` int(10) NOT NULL,
  `location` varchar(20) NOT NULL,
  `imfac` varchar(10) DEFAULT NULL,
  `sci` int(10) NOT NULL,
  `isbn` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `journal`:
--

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`issn`, `date`, `jname`, `issue`, `volume`, `location`, `imfac`, `sci`, `isbn`) VALUES
(18, '2013-02-01', ' IEEE Transaction on Nuclear Science', 0, 60, 'Foreign', '1.447', 1, 0),
(0, '2012-11-05', 'Asian Conference on Computer Vision (ACCV)', 0, 0, 'Domestic', '', 0, 0),
(0, '2012-10-07', 'European Conference on Computer Vision (ECCV)', 0, 0, 'Foreign', '', 0, 0),
(0, '2012-10-29', 'IEEE Medical Imaging Conference', 0, 0, 'Domestic', '', 0, 0),
(1077, '2012-12-01', 'IEEE Transactions on Visualization and Computer Graphics', 0, 18, 'Foreign', '2.215', 1, 0),
(1422, '2013-10-15', 'International Journal of Molecular Sciences', 0, 14, 'Foreign', '2.464', 1, 0),
(94, '2013-03-01', 'Medical Physics', 0, 40, 'Foreign', '2.830', 1, 0),
(0, '2013-02-09', 'SPIE Medical Imaging', 0, 0, 'Foreign', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paper`
--

CREATE TABLE IF NOT EXISTS `paper` (
  `papertype` varchar(20) NOT NULL,
  `ptitle` varchar(100) NOT NULL,
  `fauthor` varchar(20) NOT NULL,
  `coauthor` varchar(50) NOT NULL,
  `abstract` varchar(3000) NOT NULL,
  `jname` varchar(100) DEFAULT NULL,
  `area` varchar(20) NOT NULL,
  `stpage` int(10) NOT NULL,
  `endpage` int(10) NOT NULL,
  `year` int(10) NOT NULL,
  `country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `paper`:
--   `namecon`
--       `journal` -> `jname`
--   `jname`
--       `journal` -> `jname`
--

--
-- Dumping data for table `paper`
--

INSERT INTO `paper` (`papertype`, `ptitle`, `fauthor`, `coauthor`, `abstract`, `jname`, `area`, `stpage`, `endpage`, `year`, `country`) VALUES
('Journal', 'Database-Assisted Low-Dose CT Image Restoration', 'Wei Xu', 'Sungsoo Ha, Klaus Mueller', 'The image quality of low-dose CT scans typically suffers greatly from the limited utilization of X-ray radiation. Although the harmful effects to patient health are reduced, the low quality of the reconstructions make', 'Medical Physics', 'Medical Imaging', 1, 7, 2013, 'US'),
('Conference', 'Detection of Low-Dose CT Reconstruction Artifacts Using a Bi-Modal Approach', 'Salman Mahmood', 'Klaus Mueller', 'Low-dose Computed Tomography (CT) has the benefit of exposing patients to less radiation. However, low dose CT requires special reconstruction techniques to improve the clarity of the image. Unfortunately, these special reconstruction techniques often cannot remove all of the low-dose artifacts. It is important to recognize these artifacts else we run the risk of obscuring important detail or adding false features. In this work, we present a simple scheme which allows us to detect these artifacts. Our technique applies to the specific low-dose CT strategy in which the number of X-ray views taken from the patient is reduced. The first step uses directional interpolation in the low dose sinogram to add more views. While the image created from this interpolated sinogram does not have any artifacts it lacks significantly in clarity due to blurring. Our scheme then compares this image with the image created directly with a low-dose CT reconstruction technique which has better detail but also some remaining artifacts. The comparison reveals these artifacts which we then remove by simple pixel replacement. © (2013) COPYRIGHT Society of Photo-Optical Instrumentation Engineers (SPIE). Downloading of the abstract is permitted for personal use only.', 'SPIE Medical Imaging', 'Medical Imaging', 1, 7, 2013, 'US'),
('Journal', 'GPU-Accelerated Forward and Back-Projections with Spatially Varying Kernels for 3D DIRECT TOF PET Re', 'Sungsoo Ha ', 'S Matej, M Ispiryan, K Mueller', 'We describe a GPU-accelerated framework that efficiently models spatially (shift) variant system response kernels and performs forward- and back-projection operations with these kernels for the DIRECT (Direct Image Reconstruction for TOF) iterative reconstruction approach.', ' IEEE Transaction on Nuclear Science', 'Medical Imaging', 166, 173, 2013, 'US'),
('Conference', 'GPU-Accelerated Forward and Backward Projection with Spatially Varying Kernels in 3D DIRECT TOF PET ', 'Sungsoo Ha ', 'S Matej, M Ispiryan, Klaus Mueller', 'and performs forward- and back-projection operations with these kernels for the DIRECT (Direct Image Reconstruction for TOF) iterative reconstruction approach. Inherent challenges arise from the poor memory cache performance at non-axis aligned TOF directions. Focusing on the GPU memory access patterns, we utilize different kinds of GPU memory according to these patterns in order to maximize the memory cache performance. We also exploit the GPU instruction-level parallelism to efficiently hide long latencies from the memory operations. Our experiments indicate that our GPU implementation of the projection operators has slightly faster or approximately comparable time performance than FFT-based approaches using state-of-the-art FFTW routines. However, most importantly, our GPU framework can also efficiently handle any generic system response kernels, such as spatially symmetric and shift-variant as well as spatially asymmetric and shift-variant, both of which an FFT-based approach cannot cope with.', 'IEEE Medical Imaging Conference', 'Medical Imaging', 166, 173, 2012, 'KS'),
('Journal', 'Mass Spectrometry Coupled Experiments and Protein Structure Modeling Methods', 'Jaewoo Pi', 'Lee Sael', 'With the accumulation of next generation sequencing data, there is increasing interest in the study of intra-species difference in molecular biology, especially in relation to disease analysis. Furthermore, the dynamics of the protein is being identified as a critical factor in its function. Although accuracy of protein structure prediction methods is high, provided there are structural templates, most methods are still insensitive to amino-acid differences at critical points that may change the overall structure. Also, predicted structures are inherently static and do not provide information about structural change over time. It is challenging to address the sensitivity and the dynamics by computational structure predictions alone. However, with the fast development of diverse mass spectrometry coupled experiments, low-resolution but fast and sensitive structural information can be obtained. This information can then be integrated into the structure prediction process to further improve the sensitivity and address the dynamics of the protein structures. For this purpose, this article focuses on reviewing two aspects: the types of mass spectrometry coupled experiments and structural data that are obtainable through those experiments; and the structure prediction methods that can utilize these data as constraints. Also, short review of current efforts in integrating experimental data in the structural modeling is provided.', 'International Journal of Molecular Sciences', 'Computational Biolog', 20635, 20657, 2013, 'CN'),
('Journal', 'SketchPadN-D: WYDIWYG Sculpting and Editing in High-Dimensional Space', 'Bing Wang', 'Puripanth Ruchikachorn, Klaus Mueller', 'High-dimensional data visualization has been attracting much attention. To fully test related software and algorithms, researchers require a diverse pool of data with known and desired features. Test data do not always provide this, or only partially. Here we propose the paradigm WYDIWYGS (What You Draw Is What You Get). Its embodiment, SketchPadND, is a tool that allows users to generate high-dimensional data in the same interface they also use for visualization. This provides for an immersive and direct data generation activity, and furthermore it also enables users to interactively edit and clean existing high-dimensional data from possible artifacts. SketchPadND offers two visualization paradigms, one based on parallel coordinates and the other based on a relatively new framework using an N-D polygon to navigate in high-dimensional space. The first interface allows users to draw arbitrary profiles of probability density functions along each dimension axis and sketch shapes for data density and connections between adjacent dimensions. The second interface embraces the idea of sculpting. Users can carve data at arbitrary orientations and refine them wherever necessary. This guarantees that the data generated is truly high-dimensional. We demonstrate our tool’s usefulness in real data visualization scenarios', 'IEEE Transactions on Visualization and Computer Graphics', 'Visualization', 2060, 2069, 2013, 'US');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pid` int(10) NOT NULL,
  `projname` varchar(20) NOT NULL,
  `ptitle` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `project`:
--   `ptitle`
--       `paper` -> `ptitle`
--

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `projname`, `ptitle`) VALUES
(3, 'CISCO', 'GPU-Accelerated Forward and Back-Projections with Spatially Varying Kernels for 3D DIRECT TOF PET Re'),
(4, 'NVIDIA', 'GPU-Accelerated Forward and Back-Projections with Spatially Varying Kernels for 3D DIRECT TOF PET Re'),
(5, 'GFA', 'Database-Assisted Low-Dose CT Image Restoration'),
(6, 'ASQ', 'Database-Assisted Low-Dose CT Image Restoration'),
(7, 'Molecular Biology', 'Mass Spectrometry Coupled Experiments and Protein Structure Modeling Methods'),
(9, 'Med', 'Detection of Low-Dose CT Reconstruction Artifacts Using a Bi-Modal Approach'),
(10, 'CT', 'GPU-Accelerated Forward and Backward Projection with Spatially Varying Kernels in 3D DIRECT TOF PET ');

-- --------------------------------------------------------

--
-- Table structure for table `projpaper`
--

CREATE TABLE IF NOT EXISTS `projpaper` (
  `pid` int(10) NOT NULL,
  `ptitle` varchar(100) NOT NULL,
  `cont` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `projpaper`:
--   `pid`
--       `project` -> `pid`
--   `ptitle`
--       `paper` -> `ptitle`
--

--
-- Dumping data for table `projpaper`
--

INSERT INTO `projpaper` (`pid`, `ptitle`, `cont`) VALUES
(3, 'GPU-Accelerated Forward and Back-Projections with Spatially Varying Kernels for 3D DIRECT TOF PET Re', 30),
(4, 'GPU-Accelerated Forward and Back-Projections with Spatially Varying Kernels for 3D DIRECT TOF PET Re', 70),
(5, 'Database-Assisted Low-Dose CT Image Restoration', 40),
(6, 'Database-Assisted Low-Dose CT Image Restoration', 60),
(7, 'Mass Spectrometry Coupled Experiments and Protein Structure Modeling Methods', 100),
(9, 'Detection of Low-Dose CT Reconstruction Artifacts Using a Bi-Modal Approach', 90),
(10, 'GPU-Accelerated Forward and Backward Projection with Spatially Varying Kernels in 3D DIRECT TOF PET ', 60);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `user` int(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `fname`, `lname`, `designation`) VALUES
(0, 110045896, 'ayush', 'Ayush', 'Kumar', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`jname`);

--
-- Indexes for table `paper`
--
ALTER TABLE `paper`
  ADD PRIMARY KEY (`ptitle`), ADD KEY `namecon` (`jname`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pid`), ADD KEY `ptitle` (`ptitle`);

--
-- Indexes for table `projpaper`
--
ALTER TABLE `projpaper`
  ADD PRIMARY KEY (`pid`,`ptitle`), ADD KEY `projid` (`pid`), ADD KEY `title` (`ptitle`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paper`
--
ALTER TABLE `paper`
ADD CONSTRAINT `paper_ibfk_1` FOREIGN KEY (`jname`) REFERENCES `journal` (`jname`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`ptitle`) REFERENCES `paper` (`ptitle`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projpaper`
--
ALTER TABLE `projpaper`
ADD CONSTRAINT `projpaper_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `project` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `projpaper_ibfk_2` FOREIGN KEY (`ptitle`) REFERENCES `paper` (`ptitle`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
