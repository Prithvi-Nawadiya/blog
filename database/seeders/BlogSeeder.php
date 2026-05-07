<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        $adminId = $admin ? $admin->id : 1;

        $blogs = [
            [
                'title' => 'SSC GD Constable Recruitment 2026: Notification, Vacancy, and Eligibility',
                'category' => 'Latest Jobs',
                'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?q=80&w=1000&auto=format&fit=crop',
                'content' => '
                    <h2>SSC GD Constable Notification 2026</h2>
                    <p>The Staff Selection Commission (SSC) has officially released the recruitment notification for General Duty (GD) Constables in BSF, CISF, ITBP, CRPF, and SSB for the year 2026. This is a golden opportunity for candidates looking to serve in the paramilitary forces.</p>
                    
                    <h3>Vacancy Details</h3>
                    <p>Total vacancies reported are approximately <strong>25,000+</strong> across various departments:</p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Force</th>
                                <th>Male Vacancies</th>
                                <th>Female Vacancies</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>BSF</td>
                                <td>6,411</td>
                                <td>1,056</td>
                            </tr>
                            <tr>
                                <td>CISF</td>
                                <td>10,215</td>
                                <td>1,123</td>
                            </tr>
                            <tr>
                                <td>CRPF</td>
                                <td>3,214</td>
                                <td>542</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Eligibility Criteria</h3>
                    <ul>
                        <li><strong>Education:</strong> Must have passed 10th Class (Matriculation) from a recognized board.</li>
                        <li><strong>Age Limit:</strong> 18 to 23 years as of January 1, 2026. (Age relaxation applicable as per govt rules).</li>
                    </ul>

                    <blockquote>
                        Note: Candidates must ensure they meet the physical standard requirements before applying.
                    </blockquote>

                    <h3>Important Dates</h3>
                    <ol>
                        <li>Notification Release: August 15, 2025</li>
                        <li>Online Application Start: September 1, 2025</li>
                        <li>Last Date to Apply: September 30, 2025</li>
                        <li>CBT Exam Date: January - February 2026</li>
                    </ol>

                    <h3>Selection Process</h3>
                    <p>The recruitment involves the following stages:</p>
                    <ul>
                        <li>Computer Based Examination (CBE)</li>
                        <li>Physical Efficiency Test (PET)</li>
                        <li>Physical Standard Test (PST)</li>
                        <li>Medical Examination (DME/RME)</li>
                    </ul>
                ',
                'user_id' => $adminId,
            ],
            [
                'title' => 'NEET UG Admit Card 2026 Released: Direct Link to Download',
                'category' => 'Admit Cards',
                'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80&w=1000&auto=format&fit=crop',
                'content' => '
                    <h2>NEET UG 2026 Admit Card Out</h2>
                    <p>The National Testing Agency (NTA) has released the admit cards for the National Eligibility cum Entrance Test (NEET-UG) 2026. Candidates who registered for the medical entrance exam can now download their hall tickets from the official portal.</p>

                    <h3>Exam Timing & Schedule</h3>
                    <p>The exam is scheduled to be held on May 3, 2026, in a single shift from 2:00 PM to 5:20 PM.</p>

                    <h3>Required Documents for Exam Centre</h3>
                    <p>Candidates must carry the following items to the examination hall:</p>
                    <ul>
                        <li>Printed copy of NEET Admit Card with passport size photo pasted on it.</li>
                        <li>One passport size photograph (to be pasted on attendance sheet).</li>
                        <li>Valid Original ID proof (Aadhar Card, PAN Card, Voter ID, etc.).</li>
                        <li>PwD certificate (if applicable).</li>
                    </ul>

                    <h3>How to Download Admit Card</h3>
                    <ol>
                        <li>Visit the official NTA NEET website.</li>
                        <li>Click on the "NEET UG 2026 Admit Card" link.</li>
                        <li>Enter your Application Number and Date of Birth.</li>
                        <li>Submit and your admit card will appear on the screen.</li>
                        <li>Download and take a clear color printout.</li>
                    </ol>

                    <h3>Exam Pattern 2026</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>No. of Questions</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Physics</td>
                                <td>45</td>
                                <td>180</td>
                            </tr>
                            <tr>
                                <td>Chemistry</td>
                                <td>45</td>
                                <td>180</td>
                            </tr>
                            <tr>
                                <td>Biology (Botany + Zoology)</td>
                                <td>90</td>
                                <td>360</td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'user_id' => $adminId,
            ],
            [
                'title' => 'TCS Off Campus Hiring 2026: Apply for Ninja and Digital Profiles',
                'category' => 'Latest Jobs',
                'image' => 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=1000&auto=format&fit=crop',
                'content' => '
                    <h2>TCS Recruitment for 2026 Batch</h2>
                    <p>Tata Consultancy Services (TCS) has announced its integrated off-campus hiring for the 2026 batch. This drive is open to students from B.E / B.Tech / M.E / M.Tech / MCA / M.Sc backgrounds.</p>

                    <h3>Hiring Profiles</h3>
                    <ul>
                        <li><strong>TCS Ninja:</strong> Focuses on core engineering and functional skills. Package: ₹3.36 LPA.</li>
                        <li><strong>TCS Digital:</strong> Focuses on deep-tech skills like AI, Cloud, and Data Analytics. Package: ₹7.0 LPA.</li>
                    </ul>

                    <h3>Eligibility Criteria</h3>
                    <p>Minimum 60% or 6 CGPA throughout academics (10th, 12th, Graduation, and Post-Graduation). Only 1 active backlog is allowed at the time of appearing for the process.</p>

                    <h3>Selection Process</h3>
                    <ol>
                        <li>TCS NQT (National Qualifier Test) - Online Assessment</li>
                        <li>Technical Interview</li>
                        <li>HR Interview</li>
                    </ol>

                    <blockquote>
                        "TCS is looking for candidates with a strong foundation in programming and logical reasoning."
                    </blockquote>

                    <h3>Required Skills</h3>
                    <p>Proficiency in at least one programming language (C, C++, Java, Python), good communication skills, and knowledge of RDBMS concepts.</p>
                ',
                'user_id' => $adminId,
            ],
            [
                'title' => 'UPSC Civil Services (IAS) Final Result 2026 Out',
                'category' => 'Results',
                'image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80&w=1000&auto=format&fit=crop',
                'content' => '
                    <h2>UPSC CSE 2026 Results Declared</h2>
                    <p>The Union Public Service Commission (UPSC) has announced the final results for the Civil Services Examination 2026. A total of 933 candidates have been recommended for appointment to various services including IAS, IFS, IPS, and Central Services.</p>

                    <h3>Top 5 Rank Holders</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Name of Candidate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Aditya Srivastava</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Animesh Pradhan</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Donuru Ananya Reddy</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>P.K. Sidharth Ramkumar</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Ruhani</td>
                            </tr>
                        </tbody>
                    </table>

                    <h3>Cut-off Marks (Expected)</h3>
                    <p>The official cut-off marks for Prelims and Mains will be released shortly on the UPSC website. General category cut-off is expected to be around 87-90 for Prelims.</p>

                    <h3>Next Stages</h3>
                    <p>Recommended candidates will now undergo foundation training at LBSNAA, Mussoorie, and other respective academies based on their service allocation.</p>
                ',
                'user_id' => $adminId,
            ],
            [
                'title' => 'Delhi Police Head Constable Recruitment 2026: 800+ Vacancies',
                'category' => 'Latest Jobs',
                'image' => 'https://images.unsplash.com/photo-1621243804936-775306a8f2e3?q=80&w=1000&auto=format&fit=crop',
                'content' => '
                    <h2>Delhi Police Head Constable (Ministerial) Vacancy</h2>
                    <p>Delhi Police has invited applications for the post of Head Constable (Ministerial) for the 2026 session. This recruitment drive aims to fill over 800 vacancies in the department.</p>

                    <h3>Eligibility and Age Limit</h3>
                    <ul>
                        <li><strong>Education:</strong> 12th Pass from a recognized board.</li>
                        <li><strong>Typing Speed:</strong> English Typing - 30 wpm OR Hindi Typing - 25 wpm.</li>
                        <li><strong>Age:</strong> 18 to 25 years (General category).</li>
                    </ul>

                    <h3>Selection Process</h3>
                    <ol>
                        <li>Computer Based Examination (100 Marks)</li>
                        <li>Physical Endurance & Measurement Test (Qualifying)</li>
                        <li>Typing Test on Computer (25 Marks)</li>
                        <li>Computer (Formatting) Test (Qualifying)</li>
                    </ol>

                    <h3>Salary Details</h3>
                    <p>Pay Level-4 (₹25,500 to ₹81,100) plus usual allowances as per Central Government rules.</p>

                    <h3>Physical Standards (Minimum)</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Height (Male)</th>
                                <th>Height (Female)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>General/OBC/SC</td>
                                <td>165 cm</td>
                                <td>157 cm</td>
                            </tr>
                            <tr>
                                <td>ST</td>
                                <td>160 cm</td>
                                <td>152 cm</td>
                            </tr>
                        </tbody>
                    </table>
                ',
                'user_id' => $adminId,
            ],
        ];

        foreach ($blogs as $blogData) {
            Blog::updateOrCreate(
                ['title' => $blogData['title']],
                $blogData
            );
        }
    }
}
