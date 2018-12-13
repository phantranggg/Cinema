--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.4.14
-- Started on 2018-10-23 14:56:06

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 179 (class 1259 OID 17472)
-- Name: movies; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE movies (
    id integer NOT NULL,
    title character varying(70) NOT NULL,
    score integer,
    director character varying(100),
    country character varying(20),
    release_date date NOT NULL,
    length integer,
    subtitle character varying(50),
    genres character varying(50),
    rating character varying(5),
    url character varying(200) NOT NULL,
    status smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    like_num integer,
    ticket_num integer
);


ALTER TABLE movies OWNER TO postgres;

--
-- TOC entry 178 (class 1259 OID 17470)
-- Name: movies_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE movies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE movies_id_seq OWNER TO postgres;

--
-- TOC entry 2035 (class 0 OID 0)
-- Dependencies: 178
-- Name: movies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE movies_id_seq OWNED BY movies.id;


--
-- TOC entry 1917 (class 2604 OID 17475)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY movies ALTER COLUMN id SET DEFAULT nextval('movies_id_seq'::regclass);


--
-- TOC entry 2030 (class 0 OID 17472)
-- Dependencies: 179
-- Data for Name: movies; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY movies (id, title, score, director, country, release_date, length, subtitle, genres, rating, url, status, created_at, updated_at, like_num, ticket_num) FROM stdin;
26	Trò Chơi X	6	Sean Carter	USA	2017-12-29	89	Tiếng Việt	Hồi hộp	C18	trochoix.jpg	1	\N	2017-12-31 19:07:17	0	0
38	Coco	9	Lee Unkrich, Adrian Molina	USA	2017-11-24	127	Tiếng Việt	Gia đình, hoạt hình	P	coco.jpg	1	\N	2018-06-24 03:40:50	3	25
17	Tôn Ngộ Không Đại Náo New York	6	PaulWang, Felix IP	Trung Quốc	2017-12-22	84	Tiếng Việt	Gia đình, Hoạt Hình	P	tonngokhong.jpg	1	\N	2017-12-31 19:07:17	0	0
31	Cô Ba Sài Gòn	7	Lộc Trần Kay Nguyễn 	Việt Nam	2017-11-10	100	Tiếng Anh	Tâm Lý, Thần Thoại, Tình Cảm	P	cobasaigon.jpg	1	\N	2017-12-31 19:07:17	0	0
28	Truy Lùng Cổ Vật	7	Orlando Bloom	USA	2017-11-03	95	Tiếng Việt	Hành Động	C16	truylungcovat.jpg	1	\N	2017-12-31 19:07:17	0	0
35	Justice League	7	Zack Snyder	USA, UK	2017-11-17	120	Tiếng Việt	Hành động, Phiêu lưu, Viễn tưởng	C13	justiceleague.jpg	1	\N	2017-12-31 19:29:46	2	3
15	Jumanji: Trò Chơi Kỳ Ảo	7	Jake Kasdan	USA	2017-12-22	119	Tiếng Việt	Hài, Hành Động, Phiêu Lưu	C13	jumanji.jpg	1	\N	2017-12-31 19:07:17	0	0
32	Pokémon the Movie: I Choose You!	7	Kunihiko Yuyama	Nhật Bản	2017-11-10	112	Tiếng Việt, Tiếng Anh	Hoạt hình, Phiêu lưu	P	pokemon.jpg	1	\N	2017-12-31 19:07:17	0	0
37	Mark Felt: Kẻ Đánh Bại Nhà Trắng	6	Peter Landesman	USA	2017-11-17	103	Tiếng Việt	Kịch tính, Tài liệu, Lịch sử	C16	markfelt.jpg	0	\N	2018-01-31 07:05:05	1	0
27	Trải Nghiệm Điểm Chết	8	Niels Arden Oplev	USA	2017-11-03	110	Tiếng Việt	Hồi hộp, Khoa Học Viễn Tưởng, Kinh Dị	C16	trainghiemdiemchet.jpg	1	\N	2017-12-31 19:07:17	0	0
29	Bí Ẩn Vùng Ngoại Ô	7	George Clooney	USA	2017-11-03	104	Tiếng Việt	Hành Động, Tội phạm	C18	bianvungngoaio.jpg	1	\N	2017-12-31 19:07:17	0	0
18	Ngũ Hiệp Trừ Yêu	6	Woo-Ping Yuen	Trung Quốc	2017-12-22	110	Tiếng Việt, Tiếng Anh	Hành Động	C13	nguhieptruyeu.jpg	1	\N	2017-12-31 19:07:17	0	0
11	Giấc Mộng Kinh Hoàng	7	Jonathan Hopkins	USA	2017-12-15	82	Tiếng Việt	Kinh Dị	C18	giacmongkinhhoang.jpg	1	\N	2017-12-31 19:07:17	3	0
16	Lãnh Địa Ma	6	Daric Gates	USA	2017-12-22	93	Tiếng Việt	Kinh Dị	C18	lanhdiama.jpg	1	\N	2017-12-31 19:07:17	0	0
13	Kẻ Săn Lùng Sợ Hãi	4	Victor Salva	USA	2017-12-15	102	Tiếng Việt	Hồi hộp	C18	kesanlungsohai.jpg	1	\N	2017-12-31 19:07:17	1	0
22	Điều Kỳ Diệu	8	Stephen Chbosky	USA	2017-12-29	113	Tiếng Việt	Gia đình	P	dieukydieu.jpg	1	\N	2017-12-31 19:07:17	0	0
19	Ngày Không Còn Mẹ	7	Cho Young-jun	Hàn Quốc	2017-12-25	114	Tiếng Việt, Tiếng Anh	Gia đình, Tâm Lý	P	ngaykhongconme.jpg	1	\N	2017-12-31 19:07:17	0	0
8	Vòng Xoáy Lừa Đảo	6	Chang Won Jang	Hàn Quốc	2017-12-08	107	Tiếng Việt, Tiếng Anh	Tâm Lý, Tội phạm	C16	vongxoayluadao.jpg	1	\N	2017-12-31 19:07:17	0	0
3	Lino Và 7 Kiếp Nạn	7	Rafael Ribas	Brazil	2017-12-01	93	Tiếng Việt	Hoạt hình	P	lino.jpg	1	\N	2017-12-31 19:07:17	1	4
14	Lôi Báo	7	Victor Vũ	Việt Nam	2017-12-22	107	Tiếng Anh	Hành Động, Hồi hộp, Tâm Lý	C16	loibao.jpg	1	\N	2017-12-31 19:07:17	0	0
46	Sát Thủ Vô Hình	8	Oriol Paulo	Tây Ban Nha	2017-10-06	106	Tiếng Việt	Kinh dị, Ly kỳ, Tội phạm	C16	satthuvohinh.jpg	1	\N	2017-12-31 19:07:17	0	0
39	Giao Ước Chết	6	Sophon Sakdaphisit	Thailand	2017-11-24	114	Tiếng Việt, Tiếng Anh	Drama, Kinh dị , Gay cấn	C18	giaouocchet.jpg	1	\N	2018-01-29 06:22:13	2	10
30	24 Giờ Hồi Sinh	6	Brian Smrz	USA	2017-11-03	93	Tiếng Việt	Hành động, Ly kỳ, Bí ẩn	C18	24giohoisinh.jpg	1	\N	2017-12-31 19:07:17	0	0
40	Victoria & Abdul	7	Stephen Frears	USA, UK	2017-11-24	101	Tiếng Việt	Tiểu sử, Lịch sử	C13	victoriaandabdul.jpg	1	\N	2017-12-31 19:07:17	2	9
23	Ngày Đẫm Máu : Xác Sống Trỗi Dậy	7	Hèctor Hernández Vicens	Bulgaria	2017-12-29	124	Tiếng Việt	Hồi hộp, Kinh dị	C18	ngaydammau.jpg	1	\N	2017-12-31 19:07:17	0	0
20	Khi Con Là Nhà	6	Vũ Ngọc Đãng	Việt Nam	2017-12-28	104	Tiếng Anh	Hài, Tình cảm	P	khiconlanha.jpg	1	\N	2017-12-31 19:07:17	0	0
44	Kẻ Ngoại Tộc	7	Martin Campbell	USA	2017-10-06	114	Tiếng Việt	Hành động, Bí ẩn, Phiêu lưu	C18	kengoaitoc.jpg	1	\N	2017-12-31 19:07:17	0	0
34	Hiểm Họa Rừng Chết	7	Greg McLean	Úc	2017-11-10	95	Tiếng Việt	Phiêu lưu, Tâm lý, Hành động	C16	hiemhoarungchet.jpg	1	\N	2017-12-31 19:07:17	0	0
12	Star Wars: Jedi Cuối Cùng	8	Rian Johnson	USA	2017-12-15	152	Tiếng Việt	Hành Động, Khoa Học Viễn Tưởng, Phiêu Lưu	C13	starwars.jpg	1	\N	2017-12-31 19:07:17	1	0
10	Ferdinand Phiêu Lưu Ký	7	Carlos Saldanha	USA	2017-12-15	108	Tiếng Việt	Gia đình, Hoạt Hình	P	ferdinand.jpg	1	\N	2017-12-31 19:07:17	2	0
9	Hàng Ma Truyện	5	Vương Tinh, Chung Thiếu Hùng	Trung Quốc	2017-12-08	90	Tiếng Việt	Hài, Phiêu Lưu	C16	hangmatruyen.jpg	1	\N	2017-12-31 19:07:17	1	0
24	Bậc Thầy Của Những Ước Mơ	8	Michael Gracey	USA	2017-12-29	110	Tiếng Việt	Nhạc kịch, Tâm Lý	P	bacthaycuanhunggiacmo.jpg	1	\N	2017-12-31 19:07:17	0	0
45	Kẻ Trộm Chó	5	Ngụy Minh Khang	Việt Nam	2017-10-06	96	Tiếng Anh	Tâm lý, Hài, Hành động	C13	ketromcho.jpg	1	\N	2017-12-31 19:07:17	0	0
7	Vòng Xoay Cám Dỗ	6	Woody Allen	USA	2017-12-08	101	Tiếng Việt	Hồi hộp, Tâm Lý, Tình cảm	C16	vongxoaycamdo.jpg	1	\N	2018-01-05 06:22:08	4	0
21	Sự Nổi Loạn Hoàn Hảo 3	6	Trish Sie	USA	2017-12-29	94	Tiếng Việt	Hài, Nhạc kịch	C13	sunoiloanhoanhao3.jpg	1	\N	2017-12-31 19:07:17	0	0
41	Thiên La Địa Võng	5	John Woo	China, Hong Kong	2017-11-24	106	Tiếng Việt	Hành động	C18	thienladiavong.jpg	1	\N	2017-12-31 19:07:17	2	0
43	Khuôn Mặt Cuối Cùng	4	Sean Penn	USA	2017-10-06	132	Tiếng Việt	Hành động, Tâm lý, Tình cảm	C16	khuonmatcuoicung.png	1	\N	2017-12-31 19:07:17	0	0
4	Thị Trấn Tình Yêu	7	Kurt Voelker	USA	2017-12-01	99	Tiếng Việt	Hài hước, Tình cảm	C16	thitrantinhyeu.jpg	1	\N	2018-01-29 06:22:05	1	3
5	Mẹ Chồng	8	Lý Minh Thắng	Việt Nam	2017-12-01	94	Tiếng Anh	Tâm Lý	C16	mechong.jpg	1	\N	2018-10-23 07:14:28	5	25
42	Vincent Thương Mến	8	Dorota Kobiela, Hugh Welchman	Ba Lan	2017-10-06	95	Tiếng Việt	Hành động, Tiểu sử, Tội phạm	C13	vincentthuongmen.jpg	1	\N	2017-12-31 19:07:17	0	0
67	Chí Phèo Ngoại Truyện	5	Danny Đỗ	Việt Nam	2017-09-15	96	Tiếng Anh	Hài, Hành động, Trinh thám	C16	chipheongoaitruyen.jpg	1	\N	2017-12-31 19:07:17	0	0
66	Chiến Trường Bushwick	5	Cary Murnion, Jonathan Milott	USA	2017-09-08	94	Tiếng Việt	Hành Động, Phiêu Lưu	C18	chientruongbushwick.jpg	1	\N	2017-12-31 19:07:17	0	0
77	Đội Quân Cảm Xúc	2	Tony Leondis	USA	2017-08-04	91	Tiếng Việt	Hoạt hình, Gia đình, Hài	P	doiquancamxuc.jpg	1	\N	2017-12-31 19:07:17	0	0
89	Góc Khuất Của Thế Giới	8	Sunao Katabuchi	Nhật Bản	2017-08-18	130	Tiếng Việt	Hoạt Hình, Tâm Lý	C13	gockhuatcuathegioi.jpg	1	\N	2017-12-31 19:07:17	0	0
50	Trong Từng Nhịp Thở	8	Andy Serkis	USA	2017-10-20	118	Tiếng Việt	Tâm Lý, Tình Cảm	C13	trongtungnhiptho.jpg	1	\N	2017-12-31 19:07:17	0	0
73	Sát Thủ Kiểu Mỹ	7	Michael Cuesta	USA	2017-09-22	112	Tiếng Việt	Hành động, Hài, Ly kỳ	C18	satthukieumy.jpg	1	\N	2017-12-31 19:07:17	0	0
56	Sinh Nhật Chết Chóc	9	Christopher Landon	USA	2017-10-27	97	Tiếng Việt	Hồi hộp	C16	sinhnhatchetchoc.jpg	1	\N	2017-12-31 19:07:17	0	0
53	Tội Phạm Nhân Bản	7	Denis Villeneuve	USA	2017-10-20	163	Tiếng Việt	Hồi hộp, Viễn Tưởng	C16	toiphamnhanban.jpg	1	\N	2017-12-31 19:07:17	0	0
62	Chú Hề Ma Quái	8	Andy Muschietti	USA	2017-09-08	135	Tiếng Việt	Kinh dị	C18	chuhemaquai.png	1	\N	2017-12-31 19:07:17	0	0
57	Nhóc Ma Siêu Quậy	5	Richard Claus, Karsten Kiilerich	USA	2017-10-27	90	Tiếng Việt	Hoạt hình, Gia Đình, Hài	P	nhocmasieuquay.jpg	1	\N	2017-12-31 19:07:17	0	0
51	Pony Bé Nhỏ	6	Jayson Thiessen	USA	2017-10-20	100	Tiếng Việt	Hoạt hình, Phiêu lưu, Hài	P	ponybenho.jpg	1	\N	2017-12-31 19:07:17	0	0
65	Kẻ Hủy Diệt 2: Ngày Phán Xét 3D	9	James Cameron	USA	2017-09-08	126	Tiếng Việt	Hành động, Ly kỳ, Giả tưởng	C16	kehuydiet2.jpg	1	\N	2017-12-31 19:07:17	0	0
52	Không Lối Thoát Hiểm	8	Joseph Kosinski	USA	2017-10-20	126	Tiếng Việt	Thảm họa, Ly kì, Hành động	C13	khongloithoathiem.jpg	1	\N	2017-12-31 19:07:17	0	0
76	Tòa Tháp Bóng Đêm	6	Nikolaj Arcel	USA	2017-08-04	95	Tiếng Việt	Phiêu lưu, Hành động, Giả tưởng	C16	toathapbongdem.jpg	1	\N	2017-12-31 19:07:17	0	0
85	Lời Nguyền Gia Tộc	6	Đặng Thái Huyền	Việt Nam	2017-08-18	95	Tiếng Anh	Kinh dị, Xã hội, Kịch tính	C16	loinguyengiatoc.jpg	1	\N	2017-12-31 19:07:17	0	0
82	Annabelle 2: Tạo Vật Quỷ Dữ	7	David F. Sandberg	USA	2017-08-11	109	Tiếng Việt	Kinh dị, Tâm lý, Hồi hộp	C18	annabelle2.jpg	1	\N	2017-12-31 19:07:17	0	0
81	Vương Quốc Xe Hơi 3	7	Brian Fee	USA	2017-08-11	110	Tiếng Việt	Hài, Hoạt hình, Phiêu lưu	P	vuongquocxehoi3.png	1	\N	2017-12-31 19:07:17	0	0
58	Trùm Hương Cảng	7	Vương Tinh	Trung Quốc	2017-10-27	127	Tiếng Việt, Tiếng Anh	Hành động, Tội phạm, Tiểu sử	C18	trumhuongcang.jpg	1	\N	2017-12-31 19:07:17	0	0
79	Linh Hồn Bạc	8	Yûichi Fukuda	Nhật Bản	2017-08-04	132	Tiếng Việt	Hành động, Hài, Hoạt hình	C16	linhhonbac.jpg	1	\N	2017-12-31 19:07:17	0	0
90	Lách Luật Kiểu Mỹ	7	Doug Liman	USA	2017-08-25	100	Tiếng Việt	Hành Động, Hồi hộp, Phiêu Lưu	C18	lachluatkieumy.png	1	\N	2017-12-31 19:07:17	0	0
78	Sắc Đẹp Ngàn Cân	6	James Ngô	Việt Nam	2017-08-04	91	Tiếng Việt	Tình Cảm, Hài, Ca Nhạc	C13	sacdepngancan.jpg	1	\N	2017-12-31 19:07:17	0	0
59	Bầu Trời Đỏ	3	Olivier Lorelle	Pháp	2017-10-27	87	Tiếng Việt	Chiến tranh, Tình cảm, Tâm lý	C16	bautroido.jpg	1	\N	2017-12-31 19:07:17	0	0
86	Vệ Sĩ Sát Thủ	7	Patrick Hughes	USA	2017-08-18	118	Tiếng Việt	Hành động, Hài, Gay cấn	C18	vesisatthu.jpg	1	\N	2017-12-31 19:07:17	0	0
49	Siêu Bão Địa Cầu	10	Gerand Bulter	USA	2017-10-13	110	Tiếng Việt	Hành Động, Phiêu Lưu	C13	sieubaodiacau.jpg	1	\N	2017-12-31 19:07:17	0	0
91	Phi Vụ Hạt Dẻ	6	Peter Lepeniotis	USA	2017-08-25	85	Tiếng Việt	Hoạt hình	P	phivuhatde.jpg	1	\N	2017-12-31 19:07:17	0	0
70	Mồi Cá Mập	4	Gerald Rascionato	USA	2017-09-15	90	Tiếng Việt	Hồi hộp, Phiêu Lưu	C16	moicamap.jpg	1	\N	2017-12-31 19:07:17	0	0
55	Thor: Tận thế Ragnarok	10	Taika Waititi	USA	2017-10-27	130	Tiếng Việt	Hành Động, Phiêu Lưu	C13	thor.jpg	1	\N	2017-12-31 19:07:17	0	0
68	Vụ Trộm May Rủi	7	Steven Soderbergh	USA	2017-09-15	110	Tiếng Việt	Hành động, Hài, Tội phạm	C13	vutrommayrui.jpg	1	\N	2017-12-31 19:07:17	0	0
84	Phi Vụ Cuối Cùng	7	Phùng Đức Luân	Trung Quốc	2017-08-11	110	Tiếng Việt, Tiếng Anh	Hành động, Hồi hộp	C16	phivucuoicung.jpg	1	\N	2017-12-31 19:07:17	0	0
88	Bố Tớ Là Chân To	6	Jeremy Degruson, Ben Stassen	USA	2017-08-18	91	Tiếng Việt	Gia đình, Hoạt Hình	P	botolachanto.jpg	1	\N	2017-12-31 19:07:17	0	0
60	Đột Kích Hồ Giấu Vàng	6	Steven Quale	Đức	2017-09-01	103	Tiếng Việt	Hành động, Phiêu lưu, Hồi hộp	C16	dotkichhogiauvang.jpg	1	\N	2017-12-31 19:07:17	0	0
74	The LEGO Ninjago Movie	6	Charlie Bean, Paul Fisher	USA	2017-09-29	103	Tiếng Việt	Gia đình, Hoạt Hình	P	thelegoninjagomovie.jpg	1	\N	2017-12-31 19:07:17	0	0
71	Kingsman: Tổ Chức Hoàng Kim	7	Matthew Vaughn	USA	2017-09-22	140	Tiếng Việt	Hành động, Hài, Võ thuật	C18	kingsman2.jpg	1	\N	2017-12-31 19:07:17	0	0
72	Amityville: Quỷ Dữ Thức Tỉnh	5	Franck Khalfoun	USA	2017-09-22	100	Tiếng Việt	Kinh dị, Kịch tính, Ly kỳ	C18	amityville.jpg	1	\N	2017-12-31 19:07:17	0	0
75	Lời Thì Thầm Của Quỷ	6	Adam Ripp	USA	2017-09-29	85	Tiếng Việt	\tKinh Dị	C16	loithithamcuaquy.png	1	\N	2017-12-31 19:07:17	0	0
54	Oan Gia Đổi Mệnh	7	Yang Song, Chiyu Zhang	Trung Quốc	2017-10-20	105	Tiếng Việt, Tiếng Anh	Hài, Hành Động	C16	oangiadoimenh.jpg	1	\N	2017-12-31 19:07:17	0	0
61	Gia Đình Là Tất Cả	5	Holger Tappe	USA	2017-09-01	96	Tiếng Việt	Gia đình, Hoạt Hình, Hài	P	giadinhlatatca.jpg	1	\N	2017-12-31 19:07:17	0	0
87	Đảo Địa Ngục	7	Ryu Seung-wan	Hàn Quốc	2017-08-18	132	Tiếng Việt, Tiếng Anh	Hành động, Lịch sử	C18	daodianguc.jpg	1	\N	2017-12-31 19:07:17	0	0
48	Tiếng Anh Là Chuyện Nhỏ	8	Hyun-seok Kim	Hàn Quốc	2017-10-13	120	Tiếng Việt, Tiếng Anh	Hài, Tâm lý, Tình cảm	C16	tienganhlachuyennho.jpg	1	\N	2017-12-31 19:07:17	0	0
108	Đời Cho Ta Bao Lần Đôi Mươi	7	Tú Vi, Văn Anh	Việt Nam	2017-07-28	83	Tiếng Anh	Tâm lý, Tình cảm, Lãng mạn	C13	doichotabaolandoimuoi.jpg	1	\N	2017-12-31 19:07:17	0	0
109	Điệp Viên Báo Thù	7	David Leitch	USA	2017-07-28	115	Tiếng Việt	Hành Động, Hồi hộp	C18	diepvienbaothu.jpg	1	\N	2017-12-31 19:07:17	0	0
80	Người Gác Đêm	6	Alain Desrochers	USA	2017-08-04	92	Tiếng Việt	Hành động	C18	nguoigacdem.jpg	1	\N	2017-12-31 19:07:17	0	0
107	Valerian và Thành phố ngàn hành tinh	7	Luc Besson	USA	2017-07-28	108	Tiếng Việt	Phiêu lưu, Hành động, Giả tưởng	C13	valerian.jpg	1	\N	2017-12-31 19:07:17	0	0
101	Siêu Tốc Độ	6	Antonio Negret	USA	2017-07-14	100	Tiếng Việt	Hành Động, Giật Gân, Hình Sự	C16	sieutocdo.jpg	1	\N	2017-12-31 19:07:17	0	0
69	Thiên Tài Bất Hảo	8	Nattawut Poonpiriya	Thái Lan	2017-09-15	130	Tiếng Việt, Tiếng Anh	Giật gân, Ly kì, Hồi hộp	C16	thientaibathao.jpg	1	\N	2017-12-31 19:07:17	0	0
93	Điệp Vụ Phản Gián	7	Michael Apted	USA	2017-08-25	120	Tiếng Việt	Hành động	C18	diepvuphangian.jpg	1	\N	2017-12-31 19:07:17	0	0
97	Người Nhện: Trở Về Nhà	8	Jon Watts	USA	2017-07-07	120	Tiếng Việt	Hành Động, Viễn Tưởng, Phiêu Lưu	C13	nguoinhen.jpg	1	\N	2017-12-31 19:07:17	0	0
1	Án Mạng Trên Chuyến Tàu Tốc Hành Phương Đông	8	Kenneth Branagh	USA	2017-12-01	114	Tiếng Việt	Tội phạm, Hổi hộp, Bí ẩn	C16	anmangtrenchuyentautochanhphuongdong.jpg	1	\N	2018-01-29 06:22:03	-1	8
106	Cuộc Giải Cứu Đếm Ngược	6	Chang	Trung Quốc	2017-07-21	105	Tiếng Việt, Tiếng Anh	Hành Động	C16	cuocgiaicuudemnguoc.jpg	1	\N	2017-12-31 19:07:17	0	0
47	Biệt Đội Săn Cương Thi	6	Sin-Hang Chiu, Pak-Wing Yan	Trung Quốc	2017-10-13	80	Tiếng Việt, Tiếng Anh	Hài, Hành Động	C16	bietdoisancuongthi.jpg	1	\N	2017-12-31 19:07:17	0	0
103	Cuộc Di Tản Dunkirk	9	Christopher Nolan	USA	2017-07-21	120	Tiếng Việt	Lịch Sử, Hành Động, Tâm Lý	C16	cuocditandunkirk.jpg	1	\N	2017-12-31 19:07:17	0	0
110	Ác Nữ Báo Thù	7	Jung Byung-gil	hàn Quốc	2017-07-28	129	Tiếng Việt, Tiếng Anh	Hành động, Hình sự, Kịch tính	C18	acnubaothu.jpg	1	\N	2017-12-31 19:07:17	0	0
83	Tam Sinh Tam Thế: Thập Lý Đào Hoa	8	Trịnh Tiểu Đinh, Anthony Lamolinar	Trung Quốc	2017-08-11	109	Tiếng Việt, Tiếng Anh	Cổ trang, Tình cảm, Võ thuật	C13	tamsinhtamthe.jpg	1	\N	2017-12-31 19:07:17	0	0
33	Pháo Hoa, Nên Ngắm Từ Dưới Hay Bên Cạnh	6	 Akiyuki Shinbo, Nobuyuki Takeuchi	Nhật Bản	2017-11-10	90	Tiếng Việt, Tiếng Anh	Lãng mạn, Giả tưởng, Hoạt hình	C13	hanabi.jpg	1	\N	2017-12-31 19:07:17	0	0
92	Yêu Đi, Đừng Sợ!	6	Stephane Gauger	Việt Nam	2017-08-25	110	Tiếng Anh	Hài, Kinh dị, Tình cảm	C16	yeudidungso.jpg	1	\N	2017-12-31 19:07:17	0	0
2	Vùng Trời Diệt Vong	6	Liam ODonnell	USA	2017-12-01	105	Tiếng Việt	Hành động, Phiêu lưu, Kinh dị	C18	vungtroidietvong.jpg	1	\N	2018-01-31 06:34:28	2	11
25	Thử Thách Thần Chết: Giữa Hai Thế Giới	8	Kim Yong-Hwa	Hàn Quốc	2017-12-29	140	Tiếng Việt, Tiếng Anh	Tâm Lý, Thần thoại	C16	thuthachthanchet.jpg	1	\N	2017-12-31 19:07:17	0	0
98	Quảng Trường Ma	6	Pairach Khumwan	Thái Lan	2017-07-07	111	Tiếng Việt	Kinh dị	C16	quangtruongma.jpg	1	\N	2017-12-31 19:07:17	0	0
111	Trang	8	Trang	Lead	2017-12-01	100	Việt Nam	Ninja	C18	24giohoisinh.jpg	0	\N	2017-12-31 19:07:17	0	0
113	Trang	5	Ta	sdvs	2017-12-01	44	sdfs	Ninja	sfd	download.jpg	0	\N	2017-12-31 19:07:17	0	0
63	Câu Chuyện Lý Tiểu Long: Sự Ra Đời Của Rồng	5	George Nolfi	Trung Quốc	2017-09-08	96	Tiếng Việt	Hành động, Kịch tính, Võ thuật	C13	lytieulong.jpg	1	\N	2017-12-31 19:07:17	0	0
64	Thám Tử Lừng Danh Conan: Bản Tình Ca Màu Đỏ Thẫm	7	Kobun Shizuno	Nhật Bản	2017-09-08	100	Tiếng Việt	Phiêu lưu, Hoạt hình, Tội phạm	C13	conan.jpg	1	\N	2017-12-31 19:07:17	0	0
104	Cô Gái Đến Từ Hôm Qua	7	Phan Gia Nhật Linh	Việt Nam	2017-07-21	120	Tiếng Anh	Hài, Tình cảm, Lãng mạn	P	cogaidentuhomqua.jpg	1	\N	2017-12-31 19:07:17	0	0
102	Ngộ Không Kỳ Truyện	6	Quách Tử Kiện	Trung Quốc	2017-07-14	124	Tiếng Việt, Tiếng Anh	Hành Động, Thần Thoại, Gia Đình	C13	ngokhongkytruyen.jpg	1	\N	2017-12-31 19:07:17	0	0
105	Khi Thú Cưng Là Khủng Long	7	Matt Drummond	Úc	2017-07-21	100	Tiếng Việt	Hành Động, Viễn Tưởng, Phiêu Lưu	P	khithucunglakhunglong.jpg	1	\N	2017-12-31 19:07:17	0	0
36	Ngọn Núi Giữa Hai Ta	6	Hany Abu-Assad	USA	2017-11-17	111	Tiếng Việt	Phiêu lưu, Hành động, Tình cảm	C16	ngonnuigiuahaichungta.jpg	1	\N	2018-01-31 07:02:35	3	0
96	Chuyện Gì Xảy Ra Với Thứ Hai	7	Tommy Wirkola	USA	2017-08-31	123	Tiếng Việt	Hành động, Viễn tưởng, Thần thoại	C18	chuyengixayravoithuhai.jpg	1	\N	2017-12-31 19:07:17	0	0
99	Đại Chiến Hành Tinh Khỉ	8	Matt Reeves	USA	2017-07-14	120	Tiếng Việt	Hành Động, Phiêu Lưu, Tâm Lý	C16	daichienhanhtinhkhi.jpg	1	\N	2017-12-31 19:07:17	0	0
94	Ngôi Nhà Ma Ám	5	Rich Ragsdale	Thái Lan	2017-08-25	100	Tiếng Việt, Tiếng Anh	Kinh dị, Ma	C16	ngoinhamaam.jpg	1	\N	2017-12-31 19:07:17	0	0
95	Nắng 2	6	Đồng Đăng Giao	Việt Nam	2017-08-31	100	Tiếng Anh	Hài, Tình cảm, Gia đình	P	nang2.jpg	1	\N	2017-12-31 19:07:17	0	0
6	Bố Ngoan Bố Hư 2	6	Sean Anders	USA	2017-12-08	100	Tiếng Việt	Hài Hước	C13	bongoan.jpg	1	\N	2017-12-31 19:07:17	1	0
100	Những Kẻ Khát Tình	7	Sofia Coppola	USA	2017-07-14	100	Tiếng Việt	Hồi hộp, Tâm Lý, Hình Sự	C18	nhungkekhattinh.jpg	1	\N	2017-12-31 19:07:17	0	0
\.


--
-- TOC entry 2036 (class 0 OID 0)
-- Dependencies: 178
-- Name: movies_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('movies_id_seq', 113, true);


--
-- TOC entry 1919 (class 2606 OID 17480)
-- Name: movies_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY movies
    ADD CONSTRAINT movies_pkey PRIMARY KEY (id);


-- Completed on 2018-10-23 14:56:06

--
-- PostgreSQL database dump complete
--

