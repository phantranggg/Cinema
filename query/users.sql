--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.4.14
-- Started on 2018-10-23 14:59:22

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
-- TOC entry 183 (class 1259 OID 17521)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(40) NOT NULL,
    date_of_birth date,
    account_type character varying(10),
    email character varying(30) NOT NULL,
    phone character varying(15),
    address character varying(50),
    role character varying(10),
    password character varying(255) NOT NULL,
    status smallint NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    total_amount bigint
);


ALTER TABLE users OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 17519)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- TOC entry 2037 (class 0 OID 0)
-- Dependencies: 182
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- TOC entry 1917 (class 2604 OID 17524)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- TOC entry 2032 (class 0 OID 17521)
-- Dependencies: 183
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, name, date_of_birth, account_type, email, phone, address, role, password, status, remember_token, created_at, updated_at, total_amount) FROM stdin;
41	Trần Quý Kiên	2005-09-25	vip	kientran@gmail.com	01265896357	Hà Nội	user	$2y$10$Y3dJW9pxCsTKeTDjM2tdMuktLVGskXcdrYQHNzbJ6VPmQOjyWMPzK	0	\N	2017-12-28 13:26:34	2018-01-03 09:16:02	1470000
1	Lê Hoàng Anh	1997-01-31	normal	hoanganh@gmail.com	0962015064	Thái Nguyên	user	20150064	1	\N	\N	\N	0
2	Phạm Quốc Anh	1997-08-31	normal	quocanh@gmail.com	0920150167	Hà Giang	user	20150167	1	\N	\N	\N	0
4	Bùi Kế Dũng	1997-07-05	normal	kedung@gmail.com	0920150655	Bắc Kạn	user	20150655	1	\N	\N	\N	0
34	Thiên Địa Lợi	1952-07-26	normal	tdl@gmail.com	0956786180	Huế	user	$2y$10$64bbm72MbTTVeEKceT1SBOBzqajU9Rw0rUD05BkWrOuYFCjAR6UVK	1	Fj2TK0pHURnmHbD3NLeK2kY8X7qtgx81LndDAf8V8PjvRdsZNsTsld0nRnvL	2017-12-28 13:11:51	2017-12-28 13:11:51	0
42	Thế Vũ	1975-01-01	normal	thevu@gmail.com	0923758437	Hà Nội	user	$2y$10$sqRXpFvMKBm8E5Fy1400i.LacxynBdserEhJamunNU8vbIRXOuEoy	1	EGhU9AjwMxHuwlXMXMGo4GQwsVpW54y7cLY2cguDcdwon12rDNIAdp44OKug	2017-12-28 17:58:39	2018-01-03 09:16:02	420000
45	test1	1900-01-01	vip	test1@gmail.com	123	123	user	$2y$10$9/Ju0dTEOtUvQVO9mdfnveU0O3yxU1IkVkSltKQzX6nm2tI6OKf5.	1	oLOA3I6pLMlku3DaVXzP2AIP1mBbx2qUt13mRsWRYtmuc1cNsjT5k7aGOL8x	2017-12-31 16:05:27	2018-01-03 09:50:30	1490000
29	Phạm Hải Đăng	1995-12-02	normal	thenao@gmail.com	0987263721	Hà Nam	user	$2y$10$xhIc7hJ/x/tvAw0kmsAcrecnN7IHLrp41LDAfamgyrmjYANGRMgPe	1	cyiy3who3CyTBXESsFPcH9ydXYc04wEjm905u0MBMKSh3WgaAa4gFNG6azAo	2017-12-28 13:05:08	2017-12-28 13:05:08	0
31	Yêu Hà Nội	1973-12-23	normal	yhn@gmail.com	0982563571	Thái Bình	user	$2y$10$P6JlQT8ctLfxkK6yqtsureNhQIEhUEnx/92INly.Alb1Eo92pZ2Qq	1	OuNjpKBOj252JyQRBm29zPllUFeIxSqE4ksOMUPjonnXMJyWa5GmpByRinA1	2017-12-28 13:08:59	2017-12-28 13:08:59	0
36	Thiên Hoàng Minh Trị	1993-09-09	normal	thmt@gmail.com	0978273677	Hà Nội	user	$2y$10$L7Qyu0DoaCHf2bujh.ssp.2sPdm3abkvkPsKqhTtmMCI80UUkhfAC	1	ZIC2Wf73iLXS4GQCaHSmb8y6G81vmwHcHFjuwXPkkcAqR57vdAzZKtkOi0MJ	2017-12-28 13:13:47	2017-12-28 13:13:47	0
37	Bạn Bàn Bên	1998-03-04	normal	bbb@gmail.com	01267893009	Hà Nội	user	$2y$10$qerupxlwCf1D4MVY0oxmqup02.a1SnngdJbXOc1qM2t4.JNVz0Ore	1	I6JmgwuAxd0BwQJzdPPZocQYpEY8h9xXzzzM0akHq7BkloYsdWlAWIIVretE	2017-12-28 13:14:40	2017-12-28 13:14:40	0
38	Vũ Bê Đê	1997-10-25	normal	vbd@gmail.com	0983728371	Hà Nội	user	$2y$10$dD7VGca/O0FV4ET8/lDKSeh0.rvGDkkT7kB/PO9ihlwjAXv8wDxKm	1	h7rWQjC2CF1f1TY9yhP8U6R8RvX6wCLbq68hvfT8hIe0d3MWTAVyrHul2Vvk	2017-12-28 13:15:28	2017-12-28 13:15:28	0
44	Minh Ngọc	1997-11-13	normal	pmn@gmail.com	0987637872	Hà Nội	user	$2y$10$IooSsIRcxxqCB/5c4q/FMuiPfVuVm8aXujmYpSEI0QHV.zWqCW4CW	1	edkhEusZchWF3J1g3TsjJwye87e5E0wvHqYiFCEN6xoD1OpaqwKoeKVaaXjQ	2017-12-29 01:25:33	2018-01-03 09:16:02	480000
26	test	2000-01-01	vip	test@gmail.com	123	123	admin	$2y$10$ei6obLjogJwPcMbqg81aHOc.Jeot6gLuhpGf78fe5udfvloOAVAj.	1	rKjpKnED6RJO9Q4zVteCdh2bZlrq1RBwYk2UMIOFL3DuPecN4Axyh7OnE9tv	2017-12-28 02:39:48	2018-01-05 08:14:20	8160000
3	Trần Ngọc Bảo 	1997-11-30	normal	baochung@gmail.com	0920150413	Hà Nội	user	20150413	1	\N	\N	\N	0
5	Thế Đức Dũng	1997-11-03	normal	ducdung@gmail.com	0920150712	Hải Dương	user	20150712	1	\N	\N	\N	0
6	Lê Tiến Đạt	1997-01-16	normal	tiendat@gmail.com	0920150833	Hưng Yên	user	20150833	1	\N	\N	\N	0
7	Phạm Quang Điều	1997-12-04	normal	quangdieu@gmail.com	0920150923	Phú Thọ	user	20150923	1	\N	\N	\N	0
8	Phạm Thị Hằng	1997-01-04	normal	thihang@gmail.com	0920151264	Quảng Ninh	user	20151264	1	\N	\N	\N	0
10	Nguyễn Văn Hiệp	1997-10-01	normal	vanhiep@gmail.com	0920151438	Vĩnh Phúc	user	20151438	1	\N	\N	\N	0
11	Hà Trung Hiếu	1997-08-12	normal	trunghieu@gmail.com	0920151315	Bắc Ninh	user	20151315	1	\N	\N	\N	0
23	Trần Anh Tú	1997-12-22	normal	anhtu@gmail.com	0920154213	Hà Nội	user	20154213	1	\N	\N	\N	0
40	Phạm Hà	1992-05-07	vip	phamha@gmail.com	0983627270	Hải Dương	user	$2y$10$VPPrTcSaptQXDpaxGGgfqu15bEf1UBvlnYth1V5gikiEGvWr1QN2S	1	vh6CugvKWHFbzBgTXcTA8sllUhHVK1rWFWGI5t32hMX3RhvdAVeeoKtxSb1K	2017-12-28 13:18:18	2018-01-03 09:16:02	1130000
12	Phạm Anh Hoàng	1997-12-01	normal	anhhoang@gmail.com	0920151554	Bắc Ninh	user	20151554	1	\N	\N	\N	0
13	Nguyễn Quang Huy	1997-01-28	normal	quanghuy@gmail.com	0920151691	Ninh Bình	user	20151691	1	\N	\N	\N	0
14	Nguyễn Xuân Khoa	1997-01-06	normal	xuankhoa@gmail.com	0920152019	Bắc Ninh	user	20152019	1	\N	\N	\N	0
15	Hồ Minh Khôi	1997-08-08	normal	minhkhoi@gmail.com	0920152025	Hoà Bình	user	20152025	1	\N	\N	\N	0
16	Lương Tuấn Linh	1997-03-11	normal	tuanlinh@gmail.com	0920152186	Hà Nội	user	20152186	1	\N	\N	\N	0
17	Phạm Hoàng Long	1997-10-08	normal	hoanglong@gmail.com	0920152285	Hưng Yên	user	20152285	1	\N	\N	\N	0
18	Phạm Công Luận	1997-02-03	normal	congluan@gmail.com	0920152325	Sơn La	user	20152325	1	\N	\N	\N	0
19	Bùi Hoàng Minh	1997-09-07	normal	hoangminh@gmail.com	0920152420	Bắc Giang	user	20152420	1	\N	\N	\N	0
20	Trần Bảo Ngọc	1997-10-19	normal	baongoc@gmail.com	0920152711	Hà Nội	user	20152711	1	\N	\N	\N	0
21	Lê Anh Quân	1997-11-13	normal	anhquan@gmail.com	0920153015	Hà Nội	user	20153015	1	\N	\N	\N	0
35	Phạm Hưng Yên	1999-02-09	normal	ghy@gmail.com	0973826472	Hà Nội	user	$2y$10$O2Wn2FIYnSQZ8Zkj3jHUN.tGGY4PlaaPnaKbJ2lNtn1iAn1Yy2ksi	1	ISvMK2oKcpLoZ0PGwCQnA1lx81ubPbSSP1ZTEU22de4rVrxzJjqzq0Q2NQUe	2017-12-28 13:12:46	2017-12-28 13:12:46	0
28	Vu	2007-11-11	normal	vu@gmail.com	0987654321	Ha Noi	user	$2y$10$MdAQVVkAwoFAlu/qCegTlunFoHamaMisBLGLmNeF0/cbDMg3zjfFa	1	l4pvl1CJhdEpwwUIfGPVcQ4uc2o8Q9D1HITuWdKmU5ah14lErkkJqvyLBALr	2017-12-28 11:57:43	2017-12-28 11:57:43	0
30	Hồ Thiên Nga	1989-03-06	normal	abe@gmail.com	0967835424	Hồ Chí Minh	user	$2y$10$luxpEcfO9mGGSqh2gvZmXeoO71MP.jPRSPnC934CH0ylZilEI0SX6	1	FXtjl1URI17yH4IZpZyOYf3zxPqJrU9koSHJ4bjMEha68amK4ykrPj9IDtuo	2017-12-28 13:06:09	2017-12-28 13:06:09	0
46	Phan Trang	1997-06-30	normal	trang@gmail.com	\N	\N	user	$2y$10$INHa1AddyV74.UwN9Q2xOuQhOjHqd6kVjgauvSmB/PJpo9BRncdjq	1	HzXxWDELmNBqJy4FVfC2YtSeksPmcw5Y2ARppcGPdHx9Md1MN2gxH4mMw9ZD	2018-06-23 17:02:43	2018-06-23 17:10:51	420000
47	trang	1212-12-12	normal	trang123@gmail.com	123	123	user	$2y$10$zQAaFzWuOAv6ZlcQywapIO8vpaQY0YFbRCLs6Eaa0GU.k8ZlA2iGe	1	\N	2018-10-23 06:55:27	2018-10-23 07:03:39	480000
43	Phan Thanh An	2004-04-11	vip	thanhan@gmail.com	0913326742	Nghệ An	user	$2y$10$mw4qVp3vDxgpVIg/CoQL/O01iMJ4HsK2bH1cavnWFjKbjtw5j3udy	1	UK0NxTPg7fIjPmfoHU3z8eSXGhlSPWPZ9BjRfWT0gJ6mU0FtydEZgtYrH2Ya	2017-12-28 18:57:18	2018-01-03 09:16:02	1280000
25	Phan Trang	1997-06-30	vip	phantrang@gmail.com	0979738008	Hà Nội	admin	$2y$10$IGoCD3LGqHObIoZV9Css8uTvc1nJozPjUtIo72l.g3sWrhTrNDeJu	1	s1Omni6aOSKr5MMQSYdMfQ8EbhllL6eguS4ybD5tlWCzqBYgZnugmWAtECNH	2017-12-27 06:58:47	2018-01-03 09:16:02	1860000
39	Hoàng An	1996-02-17	normal	hoangan@gmail.com	01274940000	Hà Nam	user	$2y$10$OGYZrsCDGsEZtH9kuqLpZ.O3bt6cuTQm1P7l8O8gI8FxntyCLftcu	1	eJgxwneZQaqZTgp1xSFFw1q1bYyvlvjmACBeHbodNwtJ0qLVWK1Y3LWwTV6P	2017-12-28 13:17:15	2017-12-28 13:17:15	0
22	Nguyễn Hồng Quân	1997-04-22	normal	hongquan@gmail.com	0920153035	Tuyên Quang	user	20153035	1	\N	\N	\N	0
9	Đào Thị Hiền	1997-02-06	normal	thihien@gmail.com	0920151377	Nam Định	user	20151377	1	DkGGXknHhCX0kZLVvjDqM0Y7M4zvTQp1gq1nQftGMU1UhgTDY7kPcuohp5VQ	\N	\N	0
32	Hồ Hải Nam	2002-01-17	normal	hhn@gmail.com	01203576512	Hà Tây	user	$2y$10$QOXNVhOFKWKBPSaVYSSI7.UOZQOGgVv2FiFfFIbr7EBEHzouHfNPq	1	Z9aipedeZuYbFOx2DomuYdvNfZ82xcI7PCkNmvndWpmdbdsjuYPSZO5L8Cxv	2017-12-28 13:10:00	2017-12-28 13:10:00	0
33	Phượng Hoàng Lửa	2001-06-25	normal	phl@gmail.com	01267389765	Ninh Bình	user	$2y$10$Wg05mlfVKV0hCXJp.l5UvuZUBAvJqV8syibi8i0XTaysT4fHeooIe	1	UglJNvVIqolfpucbUUjpyMpyVyzHg7WkSA0bnMjgeju751wkeLFyoXmQl60S	2017-12-28 13:10:48	2017-12-28 13:10:48	0
27	1234	1900-11-11	normal	1234@gmail.com	1234	1234	user	$2y$10$FT/rIjyGFC.CYh4Wn5vodexT.NZVaHcZzEPuOvB4sukan/sF0AIpm	1	IOuTR4VT3T2jiTELoSJdhiOPvSCqHP9n2KNKRL10BY3sNL4FoZWgM1lqyS2z	2017-12-28 10:27:55	2017-12-28 10:27:55	0
\.


--
-- TOC entry 2038 (class 0 OID 0)
-- Dependencies: 182
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 47, true);


--
-- TOC entry 1919 (class 2606 OID 17531)
-- Name: users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 1921 (class 2606 OID 17529)
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


-- Completed on 2018-10-23 14:59:22

--
-- PostgreSQL database dump complete
--

