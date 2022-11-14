// ignore_for_file: avoid_print

import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:jelajahsultra/screens/category_screen.dart';
import 'package:provider/provider.dart';

import '../models/wisata.dart';
import '../providers/tours.dart';

class DetailScreen extends StatefulWidget {
  static const routeName = '/detail';
  const DetailScreen({Key? key}) : super(key: key);

  @override
  State<DetailScreen> createState() => _DetailScreenState();
}

class _DetailScreenState extends State<DetailScreen> {
  bool isInit = true;

  @override
  void didChangeDependencies() {
    final wisataId = ModalRoute.of(context)?.settings.arguments;
    if (isInit) {
      Provider.of<Tours>(context).getWisata(wisataId.toString());
    }
    isInit = false;
    super.didChangeDependencies();
  }

  List<Wisata> tours = [];
  dynamic allTours;

  Future<void> getTour(Tours toursProvider) async {
    if(toursProvider.totalWisata > 0 && allTours == null) {
      setState(() {
        tours = toursProvider.allWisata;
        allTours = toursProvider;
      });
    }
  }
  
  @override
  Widget build(BuildContext context) {
    var width = MediaQuery.of(context).size.width;
    var height = MediaQuery.of(context).size.height;
    var urlPathUpload = 'http://192.168.100.188/jelajah.sultra/uploads/wisata/';

    final allToursProvider = Provider.of<Tours>(context);

    return FutureBuilder(
      future: getTour(allToursProvider),
      builder: (context, _) {
        return Scaffold(
          resizeToAvoidBottomInset: false,
          body: 
            (tours.isEmpty)
            ? Column(
              crossAxisAlignment: CrossAxisAlignment.center,
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Text(
                  'Tidak ada Data Wisata',
                  style: GoogleFonts.getFont(
                    'Quicksand',
                    fontSize: 18.0,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                InkWell(
                  onTap: () => Navigator.pop(context),
                  child: Container(
                    padding: const EdgeInsets.symmetric(
                      horizontal: 40,
                      vertical: 8,
                    ),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(8.0),
                      color: const Color.fromRGBO(3, 169, 251, 1.0)
                    ),
                    child: Text(
                      'Kembali',
                      style: GoogleFonts.getFont(
                        'Quicksand',
                        fontSize: 18.0,
                        fontWeight: FontWeight.bold,
                        color: Colors.white
                      ),
                    ),
                  ),
                )
              ],
            )
            : Stack(
            children: [
              Container(
                width: width,
                height: 250,
                decoration: BoxDecoration(
                  image: DecorationImage(
                    image: NetworkImage("$urlPathUpload${tours[0].image}"),
                    fit: BoxFit.cover,
                  )
                ),
              ),
              InkWell(
                onTap: () => Navigator.pop(context),
                child: Container(
                  margin: const EdgeInsets.only(left: 25.0, top: 35.0),
                  width: 35,
                  height: 35,
                  decoration: const BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.all(Radius.circular(35))
                  ),
                  child: const Icon(Icons.chevron_left),
                ),
              ),
              Align(
                alignment: Alignment.bottomCenter,
                child: Container(
                  height: height-240,
                  decoration: const BoxDecoration(
                    borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(25.0), 
                      topRight: Radius.circular(25.0)
                    ),
                    color: Color.fromRGBO(249, 249, 249, 1.0),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisAlignment: MainAxisAlignment.start,
                    children: [
                      Center(
                        child: Container(
                          margin: const EdgeInsets.only(top: 10.0),
                          width: 60,
                          height: 4,
                          decoration: BoxDecoration(
                            color: const Color.fromRGBO(34, 0, 34, 1.0),
                            borderRadius: BorderRadius.circular(4.0)
                          ),
                        ),
                      ),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0, top: 10),
                        child: Text(
                          tours[0].nama,
                          style: GoogleFonts.getFont(
                            'Quicksand',
                            fontSize: 18.0,
                            fontWeight: FontWeight.bold
                          ),
                        ),
                      ),
                      const SizedBox(height: 5),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            const SizedBox(
                              width: 12,
                              height: 12,
                              child: Icon(
                                Icons.location_pin,
                                size: 12,
                              ),
                            ),
                            const SizedBox(width: 5),
                            Expanded(
                              child: Text(
                                tours[0].lokasi,
                                style: GoogleFonts.getFont(
                                  'Quicksand',
                                  fontSize: 16,
                                ),  
                              ),
                            )
                          ],
                        )
                      ),
                      const SizedBox(height: 15),
                      Container(
                        width: width-50,
                        height: 2,
                        margin: const EdgeInsets.symmetric(horizontal: 25.0),
                        decoration: BoxDecoration(
                          color: const Color.fromRGBO(240, 240, 240, 1.0),
                          borderRadius: BorderRadius.circular(4),
                        ),
                      ),
                      const SizedBox(height: 5),
                      InkWell(
                        onTap: () => Navigator.pushNamed(
                          context, 
                          CategoryScreen.routeName, 
                          arguments: tours[0].kategoriId,
                        ),
                        child: Container(
                          margin: const EdgeInsets.only(left: 25),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(20.0),
                            color: const Color.fromRGBO(3, 169, 251, 1.0)
                          ),
                          padding: const EdgeInsets.symmetric(
                            horizontal: 10,
                            vertical: 4,
                          ),
                          child: Text(
                            tours[0].kategori,
                            style: GoogleFonts.getFont(
                              'Quicksand',
                              fontSize: 14,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                          ),
                        ),
                      ),
                      const SizedBox(height: 8),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Text(
                          'Jam Operasional',
                          style: GoogleFonts.getFont(
                            'Quicksand',
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),  
                        ),
                      ),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Text(
                          tours[0].jamOperasional,
                          style: GoogleFonts.getFont(
                            'Quicksand',
                          ),  
                        ),
                      ),
                      const SizedBox(height: 8),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Text(
                          'Fasilitas',
                          style: GoogleFonts.getFont(
                            'Quicksand',
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),  
                        ),
                      ),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Text(
                          tours[0].fasilitas,
                          style: GoogleFonts.getFont(
                            'Quicksand',
                          ),  
                        ),
                      ),
                      const SizedBox(height: 15),
                      Container(
                        margin: const EdgeInsets.only(left: 25.0),
                        child: Text(
                          'Deskripsi',
                          style: GoogleFonts.getFont(
                            'Quicksand',
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                          ),  
                        ),
                      ),
                      const SizedBox(height: 8),
                      Expanded(
                        flex: 1,
                        child: SingleChildScrollView(
                          scrollDirection: Axis.vertical,
                          child: Container(
                            margin: const EdgeInsets.symmetric(horizontal: 25.0),
                            child: Text(
                              tours[0].keterangan,
                              style: GoogleFonts.getFont(
                                'Quicksand',
                              ),
                            ),
                          ),
                        ) 
                      )
                    ],
                  ),
                ),
              )
            ],
          )
        );
      }
    );
  }
}