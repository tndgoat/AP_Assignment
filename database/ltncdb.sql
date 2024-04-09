-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3307
-- Thời gian đã tạo: Th4 09, 2024 lúc 11:00 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ltncdb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `name`, `role`, `updated_at`) VALUES
(1, 'admin@hcmut.edu.vn', '$2y$10$.8c8OEDgbHEUM6lmB.mJk.vppsTxRyAvHcogQbjAvD/btY1Sr3NnW', 'Admin', 1, '2024-03-25 08:47:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Xe Khách'),
(2, 'Xe Tải'),
(3, 'Xe Container');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `username`, `email`, `message`, `status`, `created_at`) VALUES
(13, 'Nguyễn Duy Tùng', 'tung.nguyen2k3hcmut@hcmut.edu.vn', 'Phản hồi đầu tiên.', 0, '2024-03-25 10:23:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL DEFAULT 'Tiền mặt khi nhận hàng',
  `payment` bigint(20) NOT NULL,
  `address_receiver` varchar(50) NOT NULL,
  `phone_receiver` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Đang xử lý','Đang giao','Đã giao') NOT NULL DEFAULT 'Đang xử lý',
  `name_receiver` varchar(50) NOT NULL DEFAULT 'Đang xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `payment_method`, `payment`, `address_receiver`, `phone_receiver`, `updated_at`, `status`, `name_receiver`) VALUES
(27, 57, 'Tiền mặt khi nhận hàng', 19000, 'KTX Khu A, ĐHQG - TP. HCM', '0354304095', '2024-04-09 08:48:02', 'Đang xử lý', 'Nguyễn Duy Tùng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_item` bigint(20) NOT NULL DEFAULT 1,
  `price` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_item`
--

INSERT INTO `order_item` (`order_id`, `product_id`, `quantity_item`, `price`) VALUES
(27, 1, 1, 19000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--

INSERT INTO `post` (`post_id`, `title`, `content`, `updated_at`, `image`) VALUES
(1, 'Nụ cười tràn đầy hy vọng', 'phá cỗ nhộn nhịp tùng dinh tùng phách. Đây cũng là dịp để gia đình sum vầy, trao nhau những món quà ý nghĩa. Tuy nhiên, không phải ai cũng có may mắn để trải qua một mùa trung thu thật trọn vẹn.\r\n\r\nNhìn vào hoàn cảnh khó khăn của các bé mồ côi, trẻ em bỏ rơi hay các em nhỏ sinh sống tại mái ấm Chùa Kỳ Quang và mái ấm Ánh Sáng, Hồng Trà Ngô Gia đã tổ chức một buổi ghé thăm phát quà trung thu để mang niềm vui đến cho các em vào ngày lễ đặc biệt này.', '2023-11-17 12:54:52', 'https://wujiateavn.com/files/upload2/files/Untitled-5.jpg'),
(2, 'CÔNG BỐ KẾT QUẢ KHÁCH HÀNG TRÚNG THƯỞNG | VÒNG QUAY MAY MẮN', 'Chúng ta đã cùng nhau tìm ra các khách hàng may mắn nhận được giải thưởng trong chương trình “Vòng Quay May Mắn”. Như vậy là các phần quà cũng đã tìm được chủ sở hữu của mình rồi., Hồng Trà Ngô Gia xin chúc mừng tất cả các bạn trúng thưởng, các bạn chưa may mắn trong lần này cũng đừng buồn nhen, hãy cùng Hồng Trà Ngô Gia đón chờ những chương trình tiếp theo nhé! \r\n\r\nDanh sách khách hàng may mắn nhận được giải thưởng sau:\r\n\r\n03 giải Nhất: Iphone 14 Promax 256G\r\n03 giải Nhì: Xe điện PEGA\r\n05 giải Ba: Loa Bluetooth JBL\r\n08 giải Tư: Nước hoa Chanel\r\n100 giải Năm: Hộp quà tặng Ngô Gia\r\nGiải Khuyến khích: dành tặng cho tất cả khách hàng', '2023-11-17 12:57:24', 'https://wujiateavn.com/files/upload2/files/gi%E1%BA%A3i%20nh%E1%BA%A5t%201.jpg'),
(3, 'THỬ HƯƠNG VỊ MỚI - RINH IPHONE 14 PROMAX VỀ NHÀ', 'Nhằm tri ân Fan của Hồng Trà Ngô Gia trong suốt những năm qua đã và luôn đồng hành, yêu quý Hồng Trà Ngô Gia. Hồng Trà Ngô Gia dành tặng cơn bão “thay mới dế yêu” với phần thưởng Iphone 14 Promax, Xe Máy Điện PEGA,... và nhiều phần quà hấp dẫn khác đang đợi Fan rinh về nhà.\r\nCơn bão thay mới “dế yêu” đang được diễn ra từ ngày 15/7/2023 đến hết 15/8/2023. Ngoài quà tặng là những chiếc Iphone 14 Promax 256GB, Hồng Trà Ngô Gia còn chuẩn bị nhiều phần quà hấp dẫn khác như: Xe Máy Điện PEGA, Loa Bluetooth JBL, Nước hoa Chanel,... khi khách hàng mua 1 trong 5 thức uống mới nằm trong chương trình ưu đãi, khách hàng sẽ nhận được 1 vòng bọc ly kèm phiếu cào trên mỗi ly thức uống. Và khi khách hàng sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, khách hàng sẽ có cơ hội tham gia thay mới “dế yêu” và nhiều phần quà hấp dẫn khác.\r\nKhông dừng lại ở những quà tặng xịn sò trên, Hồng Trà Ngô Gia còn tặng kèm bộ lắp ráp Lego trên mỗi ly thức uống, nằm trong chương chương ưu đãi. Trên mỗi vòng bọc ly sẽ có kèm theo phiếu cào, khách hàng chỉ cần xé phiếu cào để đổi thưởng Lego trực tiếp tại quán. Một tin chấn động hơn, kích thước Lego có thể lên đến cực đại. Vậy nên Fan ơi, đừng bỏ qua cơ hội “thử hương vị mới - rinh quà tặng về nhà” nhé!\r\nCÁCH THỨC THAM GIA\r\n\r\nBước 1: Order 1 trong 5 ly thức uống mới để nhận vòng bọc ly kèm thẻ cào, gồm:\r\n\r\n- Trà Sữa Ba Anh Em\r\n\r\n- Aiyu Hồng Trà Kem Tươi Hoàng Kim\r\n\r\n- Sữa Dâu Tây Trân Châu Trắng\r\n\r\n- Bát Bảo Ngô Gia\r\n\r\n- Chè Sương Sáo Nước Cốt Dừa\r\n\r\nTrên mỗi ly thức uống trên, khách hàng sẽ nhận được 01 vòng bọc ly kèm thẻ cào. \r\nBước 2: Fan nhớ xé phần thẻ cào và cào đổi Lego trực tiếp tại cửa hàng. Giữ lại Vòng bọc ly.\r\nLưu ý: Thẻ cào 100% trúng Lego, Fan nhớ đổi trực tiếp tại cửa hàng nhé!\r\n\r\nBước 3: Fan sưu tầm đủ 9 kiểu vòng bọc ly khác nhau, sau đó đến cửa hàng điền thông tin phiếu “bốc thăm trúng thưởng”. Fan nhớ gửi “phiếu bốc thăm trúng thưởng” kèm 9 kiểu vòng bọc ly về cho Ngô Gia nhé!\r\nCƠ CẤU GIẢI THƯƠNG\r\n\r\nGiải nhất: 03 Iphone 14 pro max\r\n\r\nGiải nhì: 03 Xe điện PEGA\r\n\r\nGiải ba: 05 Loa Bluetooth JBL\r\n\r\nGiải tư: 08 chai Nước hoa Chanel\r\n\r\nGiải năm: 100 Hộp quà tặng Ngô Gia\r\n\r\nGiải khuyến khích: 2200 phiếu giảm giá 5.000đ\r\n\r\nKết quả được công bố trực tiếp trên sóng Livestream của Ngô Gia.', '2023-11-17 12:59:27', 'https://wujiateavn.com/files/upload2/files/1200X1200.jpg'),
(4, 'HỒNG TRÀ NGÔ GIA ĐẠT DANH HIỆU GIẢI THƯỞNG HƯƠNG VỊ XUẤT SẮC ITQI', 'Hồng Trà Ngô Gia là một thương hiệu trà nổi tiếng tại Việt Nam và có xuất xứ từ Đài Loan, được thành lập từ năm 1995. Với hơn 25 năm kinh nghiệm trong việc sản xuất và phân phối trà, Hồng Trà Ngô Gia đã trở thành một trong những thương hiệu trà hàng đầu tại Đài Loan. Trà của Hồng Trà Ngô Gia được sản xuất từ những lá trà tươi ngon, được thu hái từ các vùng trồng trà nổi tiếng. Nhờ sử dụng các nguyên liệu chất lượng cao và quy trình sản xuất hiện đại, trà của Hồng Trà Ngô Gia luôn đảm bảo độ tươi mới và hương vị nồng nàn đặc trưng của vị trà truyền thống của Đài Loan. \r\nHồng trà Ngô Gia là một trong những loại trà nổi tiếng của Đài Loan, được sản xuất tinh túy từ những lá trà tươi ngon nhất. Với quy trình chế biến đặc biệt cùng công nghệ tiên tiến, Hồng Trà Ngô Gia đã đạt được danh hiệu giải thưởng hương vị xuất sắc iTQi do Viện Thẩm định Hương vị Quốc Tế (International Taste & Quality Institute) tại Brussels, Bỉ.\r\n\r\n \r\n\r\nĐược biết đến là một trong những giải thưởng có uy tín nhất thế giới trong lĩnh vực đánh giá sản phẩm ăn uống, giải thưởng iTQi chỉ được trao cho các sản phẩm có chất lượng đỉnh cao và đạt chuẩn hương vị tuyệt vời. Với danh hiệu này, Hồng Trà Ngô Gia đã khẳng định vị trí của mình trong thị trường trà quốc tế và được rất nhiều người tiêu dùng tin tưởng sử dụng hàng ngày.\r\n\r\nHồng trà Ngô Gia có màu sắc đỏ nâu huyền thoại, hương thơm đậm đà ngọt ngào, vị đắng thanh mát, giúp làm dịu cảm giác mệt mỏi và tạo ra một trạng thái thư giãn cho người sử dụng. Cùng với độ tinh khiết cao và hương vị đặc biệt, Hồng Trà Ngô Gia đang trở thành lựa chọn yêu thích của rất nhiều người trên thế giới.', '2023-11-17 13:00:20', 'https://wujiateavn.com/files/upload2/images/z4280613958518_0ed7dc93b8774d9ae5d6cbaf41b459b6.jpg'),
(5, 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI', 'HỒNG TRÀ KEM TƯƠI | SỰ KẾT HỢP HOÀN HẢO GIỮA TRÀ VÀ KEM TƯƠI\r\nHồng Trà Kem Tươi đây là một thức uống mới đầy hấp dẫn, được pha trộn tinh tế từ trà đen và kem tươi ngon tuyệt.\r\n\r\n\r\nTừ lâu, trà là một thức uống được yêu thích bởi nhiều người vì sự thanh mát, thư giãn và tác dụng tốt cho sức khỏe. Và gần đây, xu hướng uống trà kết hợp với kem tươi đang ngày càng trở nên phổ biến tại giới trẻ ở Việt Nam. Và hôm nay, chúng tôi xin giới thiệu đến bạn một loại thức uống mới - Hồng Trà Kem Tươi - một sự kết hợp hoàn hảo giữa trà đen và kem tươi.\r\n\r\nHồng Trà Kem Tươi là một trong những thức uống được yêu thích của Hồng Trà Ngô Gia tại Đài Loan và hôm nay đã chính thức được mở bán tại Việt Nam. Được chế biến từ lá trà tươi và kem tươi ngon miệng, sản phẩm này mang đến cho người dùng một trải nghiệm mới lạ và đầy hấp dẫn.\r\n\r\nVới hương vị nhẹ nhàng của trà đen và vị béo ngậy của kem tươi, Hồng Trà Kem Tươi sẽ khiến bạn thích thú ngay từ lần đầu tiên thưởng thức. Không những thế, sản phẩm còn được bổ sung thêm các thành phần tự nhiên tốt cho sức khỏe như đường và sữa tươi, giúp tăng cường hương vị và dinh dưỡng.\r\n\r\nHồng Trà Kem Tươi có hương vị đậm đà, mạnh mẽ từ trà đen, cùng vị ngọt mát, béo ngậy từ kem tươi. Thưởng thức Hồng Trà Kem Tươi, bạn sẽ cảm nhận được sự kết hợp hoàn hảo giữa hương vị truyền thống của trà đen chuẩn Đài Loan và vị béo ngậy của kem tươi. Bạn có thể thưởng thức sản phẩm này vào bất kỳ thời điểm nào trong ngày, từ buổi sáng để bắt đầu một ngày mới đầy năng lượng đến buổi tối để thư giãn sau một ngày làm việc mệt mỏi.\r\n\r\nNgoài ra, Hồng Trà Kem Tươi còn là một lựa chọn tuyệt vời cho các buổi họp mặt gia đình, bạn bè hoặc các sự kiện đặc biệt. Sản phẩm này sẽ khiến buổi họp mặt của bạn thêm phần thú vị. Với chất lượng tốt và giá cả phải chăng, Hồng Trà Kem Tươi đang trở thành một thức uống được yêu thích và được nhiều người lựa chọn. Chúng tôi hy vọng rằng sản phẩm này sẽ mang đến cho bạn những trải nghiệm thú vị và tuyệt vời nhất.', '2023-11-17 13:08:45', 'https://wujiateavn.com/files/upload2/images/Image_20230519095555.jpg'),
(6, 'SỮA DÂU TÂY | SẢN PHẨM MỚI CỦA HỒNG TRÀ NGÔ GIA NHƯ THẾ NÀO', 'Sữa dâu tây! Đây là một thức uống mới và đầy cảm hứng, được làm từ sữa tươi nguyên chất kết hợp với dâu tây đỏ ngọt ngào, tươi ngon. Bạn sẽ được trải nghiệm hương vị tuyệt vời của sự ngọt ngào và thơm ngon từ cả sữa và dâu tây.\r\n\r\nSữa dâu tây không chỉ thơm ngon mà còn giàu dinh dưỡng, chứa nhiều chất béo và protein cần thiết cho cơ thể. Thức uống này có thể đóng vai trò là thức uống bổ sung dinh dưỡng, giúp tăng cường sức khỏe và tăng cường động lượng cho cơ thể.\r\n\r\nSữa dâu tây là sự lựa chọn tuyệt vời cho tất cả các đối tượng từ trẻ em đến người lớn tuổi. Ngoài ra, Sữa Dâu Tây không làm từ trà nên sẽ không ảnh hướng đến giấc ngủ của bạn. Vì vậy nếu bạn đang tìm kiếm một loại thức uống mới lạ, thơm ngon và giàu dinh dưỡng, hãy đến với chúng tôi để trải nghiệm hương vị tuyệt vời của sữa dâu tây.', '2023-11-17 13:09:17', 'https://wujiateavn.com/files/upload2/files/Image_20230407150503.jpg'),
(7, 'MỪNG NGÀY 8 THÁNG 3 – HỒNG TRÀ NGÔ GIA GỬI TẶNG MÓN QUÀ TUYỆT VỜI CHO PHÁI ĐẸP', 'Nhân dịp kỷ niệm Ngày Quốc tế Phụ nữ 8 tháng 3, Hồng Trà Ngô Gia xin gửi đến quý khách hàng một chương trình đặc biệt và ý nghĩa. Trong ngày 8/3, khi quý khách nữ đến bất kỳ chi nhánh nào của Hồng Trà Ngô Gia và đặt một món đồ uống bất kỳ trong menu, sẽ được tặng kèm một cái Pudding Socola ngon tuyệt để thưởng thức.\r\n\r\nLà một trong những món Topping vừa được cho ra mắt gần đây tại Hồng Trà Ngô Gia, pudding socola đem lại hương vị ngọt ngào, hấp dẫn và rất thích hợp để làm quà tặng cho người phụ nữ thân yêu nhân dịp 8/3.\r\n\r\nHồng Trà Ngô Gia hy vọng rằng chương trình này sẽ giúp quý khách hàng thưởng thức những món ngon cùng không khí rộn ràng, ấm áp trong ngày 8/3.\r\n\r\nHãy đến Hồng Trà Ngô Gia để tận hưởng chương trình ưu đãi này và gửi lời chúc tốt đẹp đến người phụ nữ yêu thương của mình nhé!\r\n\r\nĐiều kiện áp dụng chương trình:\r\n\r\nÁp dụng khi mua hàng trực tiếp tại cửa hàng\r\nÁp dụng khi khách hàng nữ mua một đồ uống bất kỳ kèm Like và Comment bài viết trên Fanpage với nội dung “Vẫn là Hồng Trà Ngô Gia uống ngon nhất”\r\nThời gian diễn ra duy nhất trong ngày 08/03/2023', '2023-11-17 13:09:45', 'https://wujiateavn.com/files/upload2/files/h%C3%ACnh%207-3.jpg'),
(8, 'GRAND OPENING LINH ĐÔNG THỦ ĐỨC', 'Bắt đầu từ ngày 26/11 Hồng Trà Ngô Gia mời bạn đến tân gia chi nhánh mới tại 98B Linh Đông, Phường Linh Đông, Thủ Đức nà\r\n\r\nSiêu Ưu Đãi\r\n\r\nMUA 1 TẶNG 1 đến hết ngày 28/11/2022\r\nhương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.', '2023-11-17 13:10:23', 'https://wujiateavn.com/files/upload2/images/%E5%B8%A4%E6%A2%93%E6%9E%99-1.jpg'),
(9, 'TẬN HƯỞNG HƯƠNG VỊ MỚI CÙNG TRÀ SỮA SOCOLA VÀ TRÀ CHANH LÁ DỨA', 'Theo bạn thì hai món này kết hợp với Topping nào sẽ là tuyệt nhất? Cùng nhau chia sẻ kinh nghiệm ăn uống để mọi cùng tham khảo và thưởng thức thử nà!\r\n\r\nĐừng có quên nắm tay kéo vai đứa bạn thân đi cùng đó nha! Tag ngay hội bạn cùng đam mê vào hóng đi nà các bạn ơiiii', '2023-11-17 13:11:01', 'https://wujiateavn.com/files/upload2/images/ok-min.gif'),
(10, 'BẠN THỨC KHUYA SĂN SALE SỘP PEE CÒN TUI SĂN SALE HỒNG TRÀ NGÔ GIA', 'Chương trình chỉ áp dụng tại cửa hàng đang khai trương\r\n\r\nMua 1 tặng 1 áp dụng trên toàn menu\r\n\r\nKhông áp dụng giao hàng và các chương trình khuyến mãi đang hoạt động khác.\r\n\r\n-------\r\n\r\nTỚI QUẨY VỚI CHÚNG MÌNH NHOO CÁC BẠN OI\r\n\r\nĐịa chỉ :  763 Nguyễn Ảnh Thủ,P Trung Mỹ Tây, Q12\r\nHãy @tag thêm vài người bạn thân iu dấu của mình để nhận thêm nhiều ưu đãi nhaaa\r\n\r\n------\r\n\r\nWebsite: https://wujiateavn.com/\r\n\r\n#HongTraNgoGia\r\n\r\n#trasuadailoan\r\n\r\n#GrandOpening\r\n\r\n#NguyễnẢnhThủ\r\n\r\n#PhườngTrungMỹTây\r\n\r\n#Quận12\r\n', '2023-11-17 13:12:42', 'https://wujiateavn.com/files/upload/files/test.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `images` varchar(100) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `price_sale` bigint(20) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`product_id`, `name`, `category_id`, `description`, `images`, `quantity`, `price`, `price_sale`, `timestamp`) VALUES
(1, 'Xe Khách 1', 1, 'hiện đang trống', 'bus1.jpg', 10, 39000, 19000, '2024-03-25 09:15:24'),
(2, 'Xe Khách 2', 1, 'Trà chanh bí đao là sự kết hợp độc đáo giữa vị chát mà thanh của trà oolong cùng với vị chua chua của chanh và mùi thơm của vị bí đao mang đến cho bạn cảm giác mới lạ.', 'bus2.jpg', 10, 239000, 19000, '2024-03-25 09:15:30'),
(3, 'Xe Khách 3', 1, 'Hồng Trà Vải thiều là sự kết hợp giữa hồng trà và vải thiều, nước trà có vị chát, vải thiều to tròn, căng mọng nước. Hồng trà không chỉ là một loại thức uống thơm ngon mà nó còn mang lại cho chúng ta nhiều công dụng rất tốt cho sức khỏe.\r\n<br>\r\nUống Hồng Trà Vải thiều giúp cải thiện sức khỏe tim mạch, hỗ trợ tiêu hóa và giúp giảm cân vì trong trà có chứa vitamin C làm kích thích quá trình trao đổi chất và đốt cháy lượng mỡ thừa nhanh hơn.\r\n\r\n\r\n', 'bus3.jpg', 10, 39000, 19000, '2024-03-25 09:15:42'),
(4, 'Xe Khách 4', 1, 'Trà xanh hoa nhài với hương vị tự nhiên, thuần khiết.\r\n<ul>\r\n<li>Hỗ trợ giảm cân hiệu quả, Cải thiện làn da tươi trẻ mỗi ngày</li>\r\n<li>Chống oxy hóa cơ thể hằng ngày</li>\r\n<li>Điều hòa đường máu và Cân bằng đường huyết và huyết áp</li>\r\n<li>Giúp ngủ ngon sâu giấc hơn, cải thiện tình trạng mất ngủ</li>\r\n<li>Giúp giảm stress, lo âu…</li>\r\n<li>Dự phòng nguy cơ bị cảm lạnh, cúm</li>\r\n<ul>', 'bus4.jpg', 10, 39000, 19000, '2024-03-25 09:15:47'),
(5, 'Xe Khách 5', 1, 'là sự kết hợp giữa hợp hương vị chát nhẹ cùng với cảm giác tươi mát, sảng khoái của bí đao. Trà xanh bí đao mang lại một trải nghiệm vô cùng tươi mới.', 'bus5.png', 10, 39000, 19000, '2024-03-25 09:17:39'),
(6, 'Xe Khách 6', 1, 'Là sự hòa quyện của hồng trà và bí đao, thức uống hồng trà bí đao mang hương vị thơm nhẹ, ít chát hòa quyện với sự thanh mát của của bí đao.', 'bus6.jpg', 10, 39000, 19000, '2024-03-25 09:16:06'),
(7, 'Xe Tải 1', 2, 'Trà sương sáo là loại trà đặc biệt được chế biến từ lá trà tươi và sương sáo tự nhiên mang đến hương vị thơm ngon thanh mát và tinh tế.', 'truck1.jpg', 10, 39000, 19000, '2024-03-25 09:16:13'),
(8, 'Xe Tải 2', 2, 'Trà bí đao sương sáo là một loại nước giải khát thanh nhiệt. Được nhiều yêu thích bởi hương vị thơm ngon. Đây là một loại thức uống giải nhiệt tuyệt vời, thơm ngon tốt cho sức khỏe.\r\n', 'truck2.jpg', 10, 39000, 19000, '2024-03-25 09:16:19'),
(9, 'Xe Tải 3', 2, 'Món Sương Sáo Latte không làm bạn mê nhưng đem lại cảm giác dễ chịu.<br>\r\nNguyên liệu đến từ thảo mộc thiên nhiên tạo nên một thức uống giải khát hiệu quả, kết hợp vị thơm béo của sữa tươi rất healthy và balance. Để thưởng thức trọn vẹn bạn nhớ khuấy đều cho hòa quyện vào nhau nhé! ', 'truck3.jpg', 20, 39000, 16000, '2024-03-25 09:16:23'),
(10, 'Xe Tải 4', 2, 'Trân châu đường đen latte - một sự kết hợp hài hòa giữa cà phê, sữa và đường đen.\r\n<br>\r\nKhi ngửi sẽ thấy ngay mùi thơm thoang thoảng của cà phê. Nhấp môi một chút thì sẽ nếm được vị ngọt thơm đúng chuẩn hương vị đường đen, xen vào đó là độ béo của sữa càng làm tăng thêm sự quyến rũ của loại latte này.', 'truck4.jpg', 10, 39000, 19000, '2024-03-25 09:16:28'),
(11, 'Xe Tải 5', 2, 'Trà xanh Latte là món uống kết hợp giữa trà xanh và sữa tươi. Không lạnh băng như trà xanh đá xay, cũng không quá ngậy béo như trà xanh phủ kem tươi, Trà xanh Latte có vị ngon rất riêng. Không quá ngọt, không ngậy béo mà đậm hương thơm của trà, hấp dẫn với vị của sữa, đây chính là món uống hoàn hảo cho các tín đồ của trà xanh.', 'truck5.jpg', 10, 39000, 19000, '2024-03-25 09:16:34'),
(12, 'Xe Tải 6', 2, 'Sự kết hợp hài hòa giữa hồng trà, cafe latte và hương vị vải tự nhiên.', 'truck6.jpg', 10, 39000, 19000, '2024-03-25 09:16:39'),
(13, 'Xe Container 1', 3, 'Sự hòa quyện giữa latte và hương vị thanh mát của bí đao.', 'container1.jpg', 10, 239000, 19000, '2024-03-25 09:16:50'),
(14, 'Xe Container 2', 3, 'Latte truyền thống vốn được làm từ cà phê, sữa tươi và bọt sữa nay kết hợp với Hồng trà mang hương thơm thanh mát, ngọt nhẹ sẽ làm ngây ngất những ai yêu trà và thức uống latte.', 'container2.jpg', 10, 239000, 19000, '2024-03-25 09:16:54'),
(15, 'Xe Container 3', 3, 'Trà xanh kết hợp với chanh không chỉ tạo thành thức uống giải khát có vị thanh mát, chua dịu mà còn mang lại nhiều lợi ích cho sức khỏe của bạn.', 'container3.jpg', 10, 239000, 19000, '2024-03-25 09:16:59'),
(16, 'Xe Container 4', 3, 'Hồng trà chanh với hương vị ngọt nhẹ của vải thiều.', 'container4.jpg', 10, 239000, 19000, '2024-03-25 09:17:03'),
(17, 'Xe Container 5', 3, 'hiện đang trống', 'container5.jpg', 1, 0, NULL, '2024-03-25 09:17:09'),
(18, 'Xe Container 6', 3, 'hiện đang trống', 'container6.jpg', 1, 0, NULL, '2024-03-25 09:17:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT '',
  `content` text DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `verify_code` int(11) DEFAULT NULL,
  `active` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `name`, `avatar`, `phone`, `address`, `updated_at`, `verify_code`, `active`) VALUES
(57, 'tung.nguyen2k3hcmut@hcmut.edu.vn', '$2y$10$iHU/SVuPq6WA1Mp65IWJwOpg9mqRoDFiC7y3Q2DwgXCBA6bjdkZDm', 'Nguyễn Duy Tùng', NULL, '0354304095', 'KTX Khu A', '2024-03-25 09:48:51', 303320, b'1'),
(58, 'truong.tranalo888@hcmut.edu.vn', '$2y$10$/2ldFDMMpc8u5.Krlbs6ZOc7th08BVYPeVi0h6.Mgqj9q06Nxcd5O', 'Trần Duy Trường', NULL, '0123456789', 'KTX Khu B', '2024-03-28 07:29:18', 413527, b'1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_order_user` (`user_id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `FK_order_item_product` (`product_id`);

--
-- Chỉ mục cho bảng `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `FK__product` (`product_id`),
  ADD KEY `FK__user` (`user_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `FK_order_item_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_order_item_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK__product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
