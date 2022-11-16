import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AboutScreen extends StatelessWidget {
  static const routeName = '/about';
  const AboutScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      resizeToAvoidBottomInset: false,
      body: SafeArea(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const SizedBox(height: 15),
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                InkWell(
                  onTap: () => Navigator.of(context, rootNavigator: true).pop(),
                  child: Container(
                    margin: const EdgeInsets.only(left: 25.0),
                    width: 35,
                    height: 35,
                    child: const Icon(Icons.chevron_left),
                  ),
                ),
                Text(
                  'Tentang Aplikasi',
                  style: GoogleFonts.getFont(
                    'Quicksand',
                    fontSize: 18.0,
                    fontWeight: FontWeight.w900,
                  ),
                ),
                const SizedBox(width: 25),
              ],
            ),
            Expanded(child: Container(),),
            Container(
              decoration: BoxDecoration(
                color: const Color.fromRGBO(3, 169, 251, 1.0),
                borderRadius: BorderRadius.circular(8.0),
              ),
              margin: const EdgeInsets.symmetric(horizontal: 35.0),
              padding: const EdgeInsets.all(20.0),
              child: Text(
                'Aplikasi ini dikembangkan untuk memenuhi salah satu syarat memperoleh derajat sarjana teknik',
                style: GoogleFonts.getFont(
                  'Quicksand',
                  color: Colors.white,
                  fontSize: 14.0,
                ),
              ),
            ),
            Expanded(child: Container(),),
          ],
        )
      )
    );
  }
}