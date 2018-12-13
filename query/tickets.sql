--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.4.14
-- Started on 2018-10-23 14:59:05

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
-- TOC entry 185 (class 1259 OID 17553)
-- Name: tickets; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tickets (
    id integer NOT NULL,
    schedule_id integer NOT NULL,
    user_id integer NOT NULL,
    chair_num character varying(3) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE tickets OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 17551)
-- Name: tickets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tickets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tickets_id_seq OWNER TO postgres;

--
-- TOC entry 2039 (class 0 OID 0)
-- Dependencies: 184
-- Name: tickets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tickets_id_seq OWNED BY tickets.id;


--
-- TOC entry 1917 (class 2604 OID 17556)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tickets ALTER COLUMN id SET DEFAULT nextval('tickets_id_seq'::regclass);


--
-- TOC entry 2034 (class 0 OID 17553)
-- Dependencies: 185
-- Data for Name: tickets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tickets (id, schedule_id, user_id, chair_num, created_at, updated_at) FROM stdin;
7	18	25	G8	\N	\N
8	18	25	G9	\N	\N
9	39	26	E7	\N	\N
10	39	26	E8	\N	\N
11	39	26	E9	\N	\N
12	39	26	E10	\N	\N
19	11	26	E6	\N	\N
21	11	26	E7	\N	\N
24	1	26	G13	\N	\N
26	8	25	F12	\N	\N
27	8	25	F13	\N	\N
28	8	25	F14	\N	\N
29	8	25	F15	\N	\N
34	1	26	G11	\N	\N
35	1	26	G14	\N	\N
36	1	26	G12	\N	\N
42	1	26	I13	\N	\N
47	123	40	G5	\N	\N
48	123	40	G6	\N	\N
49	123	40	G7	\N	\N
50	123	40	G8	\N	\N
51	123	40	G9	\N	\N
52	12	40	G7	\N	\N
53	12	40	G6	\N	\N
54	12	40	K9	\N	\N
55	12	40	K10	\N	\N
56	30	40	D15	\N	\N
57	30	40	E15	\N	\N
58	30	40	F15	\N	\N
59	30	40	G15	\N	\N
60	30	40	H15	\N	\N
61	63	41	A11	\N	\N
62	63	41	B11	\N	\N
63	63	41	C11	\N	\N
64	63	41	D11	\N	\N
65	63	41	E11	\N	\N
66	63	41	F11	\N	\N
67	63	41	G11	\N	\N
68	63	41	H11	\N	\N
69	63	41	D1	\N	\N
70	63	41	D2	\N	\N
71	63	41	D3	\N	\N
72	63	41	D4	\N	\N
73	63	41	D5	\N	\N
74	63	41	D6	\N	\N
75	63	41	D7	\N	\N
76	63	41	D8	\N	\N
77	63	41	D10	\N	\N
78	63	41	D9	\N	\N
79	63	41	D12	\N	\N
80	63	41	E7	\N	\N
81	63	41	A1	\N	\N
204	40	45	B7	\N	\N
205	40	45	B8	\N	\N
206	94	26	D6	\N	\N
207	94	26	D7	\N	\N
89	38	25	C8	\N	\N
90	38	25	C9	\N	\N
91	38	25	C7	\N	\N
92	38	25	C10	\N	\N
93	38	25	B8	\N	\N
94	38	25	B9	\N	\N
95	38	25	B7	\N	\N
96	38	25	B10	\N	\N
97	38	25	D8	\N	\N
98	38	25	D9	\N	\N
99	38	25	E16	\N	\N
100	38	25	D7	\N	\N
208	94	26	D8	\N	\N
209	94	26	D9	\N	\N
210	114	26	G11	\N	\N
211	114	26	G12	\N	\N
212	114	26	G13	\N	\N
106	82	43	F9	\N	\N
107	82	43	F10	\N	\N
108	82	43	F11	\N	\N
213	114	26	G14	\N	\N
214	94	26	E5	\N	\N
215	94	26	E6	\N	\N
216	94	26	E7	\N	\N
113	45	43	E5	\N	\N
114	45	43	E6	\N	\N
115	45	43	E7	\N	\N
116	74	43	G12	\N	\N
117	74	43	G13	\N	\N
118	74	43	G14	\N	\N
119	74	43	H12	\N	\N
120	74	43	H13	\N	\N
121	74	43	H14	\N	\N
122	32	43	F10	\N	\N
123	32	43	F11	\N	\N
124	134	43	E12	\N	\N
125	134	43	E13	\N	\N
126	134	43	E14	\N	\N
127	38	44	D11	\N	\N
128	38	44	D10	\N	\N
129	38	44	D12	\N	\N
217	94	26	E8	\N	\N
218	94	26	E9	\N	\N
219	94	26	E10	\N	\N
220	94	26	F10	\N	\N
134	38	44	D14	\N	\N
221	94	26	F9	\N	\N
222	94	26	F8	\N	\N
223	94	26	F7	\N	\N
224	94	26	F6	\N	\N
139	15	42	E8	\N	\N
140	15	42	E9	\N	\N
141	15	42	E7	\N	\N
142	15	42	E10	\N	\N
143	29	26	E9	\N	\N
144	29	26	F9	\N	\N
145	29	26	G9	\N	\N
146	11	26	F8	\N	\N
147	11	26	E8	\N	\N
148	11	26	E10	\N	\N
149	11	26	E9	\N	\N
150	59	42	D6	\N	\N
151	59	42	D7	\N	\N
225	94	26	F5	\N	\N
226	115	26	G11	\N	\N
227	115	26	G12	\N	\N
228	115	26	G13	\N	\N
229	115	26	G14	\N	\N
230	115	26	G15	\N	\N
231	115	26	G16	\N	\N
232	115	26	G10	\N	\N
233	115	26	G17	\N	\N
234	115	26	G9	\N	\N
235	134	26	F11	\N	\N
236	134	26	F12	\N	\N
237	134	26	F13	\N	\N
238	134	26	F14	\N	\N
239	134	26	F15	\N	\N
240	134	26	F16	\N	\N
241	134	26	F17	\N	\N
242	134	26	F10	\N	\N
243	134	26	F9	\N	\N
244	134	26	F8	\N	\N
245	134	26	F7	\N	\N
246	134	26	G7	\N	\N
247	134	26	G8	\N	\N
248	134	26	G9	\N	\N
249	134	26	G10	\N	\N
250	134	26	G11	\N	\N
251	134	26	G12	\N	\N
252	134	26	G13	\N	\N
253	134	26	G14	\N	\N
254	134	26	G15	\N	\N
255	134	26	G16	\N	\N
256	134	26	G17	\N	\N
257	134	26	G18	\N	\N
258	134	26	F18	\N	\N
259	134	26	F6	\N	\N
260	134	26	G6	\N	\N
261	134	26	F19	\N	\N
262	134	26	G19	\N	\N
263	134	26	F20	\N	\N
264	134	26	G20	\N	\N
265	134	26	F5	\N	\N
266	134	26	G5	\N	\N
267	134	26	F4	\N	\N
268	134	26	G4	\N	\N
269	134	26	F3	\N	\N
270	134	26	G3	\N	\N
271	134	26	F21	\N	\N
272	134	26	G21	\N	\N
274	72	46	F12	\N	\N
275	72	46	F13	\N	\N
277	15	46	F8	\N	\N
278	15	46	F9	\N	\N
279	15	46	G7	\N	\N
280	15	46	G8	\N	\N
281	15	46	G9	\N	\N
282	15	46	G10	\N	\N
283	40	47	B9	\N	\N
284	40	47	B10	\N	\N
285	40	47	C10	\N	\N
286	40	47	C9	\N	\N
\.


--
-- TOC entry 2040 (class 0 OID 0)
-- Dependencies: 184
-- Name: tickets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tickets_id_seq', 286, true);


--
-- TOC entry 1919 (class 2606 OID 17558)
-- Name: tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);


--
-- TOC entry 1921 (class 2606 OID 17570)
-- Name: tickets_schedule_id_chair_num_unique; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tickets
    ADD CONSTRAINT tickets_schedule_id_chair_num_unique UNIQUE (schedule_id, chair_num);


--
-- TOC entry 1923 (class 2620 OID 17592)
-- Name: tg_after_insertticket; Type: TRIGGER; Schema: public; Owner: postgres
--

CREATE TRIGGER tg_after_insertticket AFTER INSERT ON tickets FOR EACH ROW EXECUTE PROCEDURE tg_check_totalamount();


--
-- TOC entry 1922 (class 2606 OID 17564)
-- Name: tickets_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tickets
    ADD CONSTRAINT tickets_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id);


-- Completed on 2018-10-23 14:59:05

--
-- PostgreSQL database dump complete
--

