--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.4.14
-- Started on 2018-10-23 14:58:41

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
-- TOC entry 181 (class 1259 OID 17495)
-- Name: theaters; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE theaters (
    id integer NOT NULL,
    name character varying(30) NOT NULL,
    hotline character varying(50),
    row_num smallint NOT NULL,
    column_num smallint NOT NULL,
    fax character varying(50),
    address character varying(70),
    status smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE theaters OWNER TO postgres;

--
-- TOC entry 180 (class 1259 OID 17493)
-- Name: theaters_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE theaters_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE theaters_id_seq OWNER TO postgres;

--
-- TOC entry 2035 (class 0 OID 0)
-- Dependencies: 180
-- Name: theaters_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE theaters_id_seq OWNED BY theaters.id;


--
-- TOC entry 1917 (class 2604 OID 17498)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY theaters ALTER COLUMN id SET DEFAULT nextval('theaters_id_seq'::regclass);


--
-- TOC entry 2030 (class 0 OID 17495)
-- Dependencies: 181
-- Data for Name: theaters; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY theaters (id, name, hotline, row_num, column_num, fax, address, status, created_at, updated_at) FROM stdin;
1	Hồ Gươm Plaza	19006017	11	13	+84 4 6 275 5240	110 Trần Phú, quận Hà Đông	1	\N	\N
3	Aeon Long Biên	19006017	12	24	+84 4 6 275 5240	27 Cổ Linh, quận Long Biên	1	\N	\N
4	Vincom Nguyễn Chí Thanh	19006017	12	19	+84 4 6 275 5240	54A Nguyễn Chí Thanh, Láng Thượng, quận Đống Đa	1	\N	\N
5	Indochina Plaza Hà Nội	19006017	5	16	+84 4 6 275 5240	241 Xuân Thủy, quận Cầu Giấy	1	\N	\N
6	Rice City	19006017	11	10	+84 4 6 275 5240	RICE CITY Linh Đàm, Hoàng Liệt, quận Hoàng Mai	1	\N	\N
7	Artemis Hà Nội	19006017	13	15	+84 4 6 275 5240	3 Lê Trọng Tấn, Khương Mai, quận Thanh Xuân	1	\N	\N
8	Hà Nội Centerpoint	19006017	8	12	+84 4 6 275 5240	27 Lê Văn Lương, Nhân Chính, quận Thanh Xuân	1	\N	\N
9	Vincom Royal City	19006017	13	24	+84 4 6 275 5240	Vincom Mega Mall Royal City, 72A Nguyễn Trãi, quận Thanh Xuân	1	\N	\N
10	Vincom Times City	19006017	15	22	+84 4 6 275 5240	Vincom Mega Mall Times City, 458 Minh Khai, quận Hai Bà Trưng	1	\N	\N
12	vu	0916555555	15	15	0909090909	ha noi	0	\N	\N
2	Mipec Tower	19006017	12	16	+84 4 6 275 5240	229 Tây Sơn, quận Đống Đa	1	\N	\N
11	Vincom Long Biên	19006017	13	20	+84 4 6 275 5240	Vinhomes Riverside, Phúc Lợi, quận Long Biên	1	\N	\N
\.


--
-- TOC entry 2036 (class 0 OID 0)
-- Dependencies: 180
-- Name: theaters_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('theaters_id_seq', 12, true);


--
-- TOC entry 1919 (class 2606 OID 17500)
-- Name: theaters_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY theaters
    ADD CONSTRAINT theaters_pkey PRIMARY KEY (id);


-- Completed on 2018-10-23 14:58:42

--
-- PostgreSQL database dump complete
--

